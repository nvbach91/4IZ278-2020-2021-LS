<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class RegisterController - Handles actions related to registering
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'reg_first_name' => ['required', 'string', 'max:255'],
            'reg_last_name' => ['required', 'string', 'max:255'],
            'reg_username' => ['required', 'string', 'max:255', 'unique:user,username'],
            'reg_email' => ['required', 'string', 'email', 'max:255', 'unique:user,email'],
            'reg_password' => ['required', 'string', 'min:8', 'confirmed'],
            'reg_password_confirmation' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Shows registration page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        return view('pages.register');
    }

    /**
     * Handles submitted registration form, either makes registration or returns with errors
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $data = $request->post();

        if ($this->validator($data)->fails()) {
            return redirect()->route('register-form')->withErrors($this->validator($data))->withInput();
        }
        else {
            $user = $this->create($data);

            auth()->login($user);
            return redirect()->route('events');
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['reg_first_name'],
            'last_name' => $data['reg_last_name'],
            'username' => $data['reg_username'],
            'email' => $data['reg_email'],
            'password' => Hash::make($data['reg_password']),
        ]);
    }
}
