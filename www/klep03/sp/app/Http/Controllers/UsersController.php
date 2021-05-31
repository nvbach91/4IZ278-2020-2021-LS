<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Inserts a new user into the DB
     */
    public function storeDefault($request)
    {
        DB::table('users')->insert([$request]);
    }

    /**
     * Returns a user with ID given
     */
    function getById($id)
    {
        return DB::table('users')->find($id);
    }

    /**
     * Hashes passsword
     * Prepares the values for the database
     * 
     * calls the storeDefault method
     */
    private function createUser($email, $password, $activationCode)
    {
        $hashedPassword = $this->hashPassword($password);
        $dbData = [
            'email' => $email,
            'password' => $hashedPassword,
            'created_at' => now(),
            'updated_at' => now(),
            'activation_code' => $activationCode
        ];
        $this->storeDefault($dbData);
    }

    /**
     * Performs the exact hashing function
     */
    function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Returns true or false
     * based on whether given email exists in the databse
     */
    function isUsedEmail($email)
    {
        $results = $this->searchByEmail($email);
        if (isset($results)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gets data from the Sign Up form
     *  - validation
     *  - generates activation code
     *  - sends activation e-mail
     *  - redirects to sign in form
     */
    function getSignUpFormData(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required | min:8',
            'confirmPassword' => 'required | same:password',
        ]);

        $data = $request->input();
        $email = $data['email'];

        if ($this->isUsedEmail($email)) {
            return redirect('signup?e=usedEmail');
        }

        $activationCode = rand(0,1000000);

        $this->createUser($data['email'], $data['password'], $activationCode);

        $mailsController = new MailsController;
        $mailsController->sendEmailConfirmation($data['email'], $activationCode);

        return redirect('signin?email=' . $email);
    }

    /**
     * Search for user with an email given
     */
    public function searchByEmail($email)
    {
        return DB::table('users')
            ->select('id')
            ->where('email', '=', $email)
            ->value('id');
    }

    /**
     * Gets data form the Sign In form, performs signin in
     */
    public function getSignInFormData(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $requestInput = $request->input();
        $email = $requestInput['email'];
        $password = $requestInput['password'];

        $id = $this->searchByEmail($email);

        $user = $this->getById($id);

        if (!$user) {
            return redirect('/signin?email=' . $email . '&error=badEmail');
        }

        if (!password_verify($password, $user->password)) {
            return redirect('/signin?email=' . $email . '&error=badPassword');
        }

        session(['user_id' => $id]);
        session(['last_activity' => time()]);
        return redirect('/?info=loginSuccessful');
    }

    /**
     * Returns true or false 
     * Decides whether is somebody currently logged in
     */
    public function isLoggedIn()
    {
        $timeout = 10 * 60;

        if (session()->has('user_id') and session()->has('last_activity')) {

            $last_activity  = intval(session('last_activity'));
            $time           = intval(time());
            $difference     = $time - $last_activity;

            if ($difference <= $timeout) {
                session(['last_activity' => time()]);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function logOut()
    {
        session(
            [
                'user_id' => null,
                'last_activity' => null
            ]
        );
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'min:3 | max:30',
            'instruments' => 'max:250'
        ]);
        $data = $request->input();

        DB::table('users')
            ->where('id', session('user_id'))
            ->update([
                'name' => $data['name'],
                'user_info' => $data['userInfo'],
                'instruments' => $data['instruments']
            ]);
        
            return redirect('/profile');
    }

    public function confirmEmail(Request $request) {
        $request->validate([
            'activationCode' => 'required',
        ]);

        $user = $this->getById(session('user_id'));

        if ($request->input('activationCode') == $user->activation_code) {
            DB::table('users')
            ->where('id', session('user_id'))
            ->update([
                'email_verified_at' => now(),
            ]);
            return redirect('/email-confirmation/?status=success');
        }
        else {
            return redirect('/email-confirmation/?status=fail');
        }
    }

    public function hasConfirmedEmail($id) {
        $user = $this->getById($id);
        
        if (null === $user->email_verified_at) {
            return false;
        } else {
            return true;
        }
    }
}
