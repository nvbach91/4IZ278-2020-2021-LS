<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class LoginController - handles login related actions
 * @package App\Http\Controllers\Auth
 */
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

    /**
     * Shows login page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        return view('pages.login');
    }

    /**
     * Method that log in user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()->route('login-form')->withErrors($validator)->withInput();
        }

        $userdata = array(
            'email' => $request->post('email') ,
            'password' => $request->post('password')
        );

        $user = User::where('email', $userdata['email']);

        if (!$user) {
            $message = 'User with this email not found. Try again.';
        }
        // attempt to do the login
        else if (auth()->attempt($userdata)) {
            return redirect()->route('events');
        }
        else {
            $message = 'Wrong password! Try again.';
        }

        return redirect()->route('login-form')->withErrors(['msg' => $message])->withInput();
    }

    /**
     * Logs out user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) {
        auth()->logout();
        session()->flush();
        return redirect()->route('home');
    }

    /**
     * Redirect to social media service for login
     * @param $service
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function authRedirect($service) {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Handle callback from social media service login
     * @param $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function authServiceCallback($service) {
        try {
            $user = Socialite::driver($service)->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // log in if user was already created
            auth()->login($existingUser, true);
        }
        else {
            // create a new user
            $fullName = $user->getName();
            $nameParts = explode(' ', $fullName);
            $first_name = $nameParts[0];

            $last_name = '';
            for ($i = 1; $i < count($nameParts); $i++) {
                $last_name .= $i == 1 ? $nameParts[$i] : ' ' . $nameParts[$i] ;
            }
            $username = is_null($user->getNickname()) ? $user->getEmail() : $user->getNickname();

            $newUserData = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'username' => $username,
                'email' => $user->getEmail(),
                'password' => '',
                'is_admin' => false
            ];
            $newUser = User::create($newUserData);
            auth()->login($newUser, true);
        }
        return redirect()->to('/home');
    }

    /**
     * Redirect to login page when trying unauthenticated access
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToLogin() {
        $message = 'You have to be signed in for this action!';
        return redirect()->route('login-form')->withErrors(['msg' => $message]);
    }

}
