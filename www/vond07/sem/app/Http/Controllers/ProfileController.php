<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(\App\Models\User $user)
    {
        
        $data = request()->validate([
            'name' => 'required',
            'phone' => '',
            'reg_number' => '',
        ]);

        if($user->id == Auth::user()->id) {
            \App\Models\User::where('id', $user->id)->update($data);

            return redirect()->action([ProfileController::class, 'index']);
        }
        return redirect()->action([ProfileController::class, 'index']);

    }

}
