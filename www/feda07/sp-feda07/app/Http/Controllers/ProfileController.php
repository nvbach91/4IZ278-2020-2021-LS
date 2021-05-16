<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\IReservationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{


    /**
     * ProfileController constructor.
     * @param IReservationService $reservationService
     */
    public function __construct( private IReservationService $reservationService)
    {

        $this->middleware('auth');
    }

    public function index(Request $request): Factory|View|Application
    {

        return view('profile',[
            'user'=> Auth::user(),

            'reservations'=>$this->reservationService->getReservationOfLoginUser()
        ]);
    }
}
