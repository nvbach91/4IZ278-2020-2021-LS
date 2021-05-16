<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        $userdata = array(
            'email' => $request->post('email') ,
            'password' => $request->post('password')
        );
        // attempt to do the login
        if (auth()->attempt($userdata))
        {
            return redirect('/events');
        }
        else
        {
            // validation not successful, send back to form
            return redirect('/home');
        }
    }

    public function logout(Request $request) {
        auth()->logout();
        session()->flush();
        return redirect('/home');
    }
}
