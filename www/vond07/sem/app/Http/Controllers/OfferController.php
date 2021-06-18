<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models;
use DB;

class OfferController extends Controller
{
    public function index()
    {
        //$this->authorize('viewAny', Auth::user());

        $offers = DB::select('select o.*, s.NAME as STATUS_NAME, si.NAME as SIZE_NAME from offer o join offer_user ou on o.ID = ou.ID_OFFER
        join status s on o.STATUS = s.ID
        join size si on si.ID = o.SIZE where ou.ID_USER = :ID', ['ID' => Auth::user()->id]);

        return view('offer.index', compact('offers'));
    }

    public function create()
    {

        $sizes = \App\Models\Size::all();
        $statuses = \App\Models\Status::all();

        return view('offer.create', [
            'sizes' => $sizes,
            'statuses' => $statuses,
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'NAME' => 'required',
            'SURFACE' => 'required',
            'SIZE' => 'required',
            'PRICE' => 'required',
            'STATUS' => 'required',
            'CITY' => 'required',
            'STREET' => 'required',
            'POSTCODE' => 'required',
        ]);


        $offerId = \App\Models\Offer::create($data);

        $dataForOfferUserTable = [
            'ID_USER' => Auth::user()->id,
            'ID_OFFER' => $offerId->id,
        ];
        
        \App\Models\OfferUser::create($dataForOfferUserTable);

        dd(request()->all());

        //return redirect('/offer');
        return redirect()->action([OfferController::class, 'index']);
        //return back()->withInput();
    }

    public function show(\App\Models\Offer $offer)
    {
        $offerUser = DB::table('offer_user')->where('ID_OFFER', $offer->ID)->first();

        $user = DB::table('users')->where('id', $offerUser->ID_USER)->first();

        return view('offer.show', compact('offer', 'user'));
    }

    public function edit(\App\Models\Offer $offer)
    {
        $this->authorize('update', $offer);

        $sizes = \App\Models\Size::all();
        $statuses = \App\Models\Status::all();
        
        return view('offer.edit', compact('offer', 'sizes', 'statuses'));
    }

    public function update(\App\Models\Offer $offer)
    {
        $data = request()->validate([
            'NAME' => 'required',
            'SURFACE' => 'required',
            'SIZE' => 'required',
            'PRICE' => 'required',
            'STATUS' => 'required',
            'CITY' => 'required',
            'STREET' => 'required',
            'POSTCODE' => 'required',
        ]);
        
        \App\Models\Offer::where('ID', $offer->ID)->update($data);

        //return redirect('/offer');
        return redirect()->action([OfferController::class, 'index']);
        //return back()->withInput();

    }
}
