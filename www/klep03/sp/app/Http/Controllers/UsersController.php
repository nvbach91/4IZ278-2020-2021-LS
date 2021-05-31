<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // DB::insert('insert into users INSERT INTO `users`(`email`, `password`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?), ');
        DB::table('users')->insert([$request]);
    }

    public function storeDefault($request)
    {
        DB::table('users')->insert([$request]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return DB::table('users')->where('id', $id)->first();
    }

    function getById($id)
    {
        $user =  DB::table('users')->find($id);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCurrentUser()
    {
        return [
            'username' => 'Not Logged in'
        ];
    }

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

    function hashPassword($password)
    {
        //TO be implemented
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function isUsedEmail($email)
    {
        $results = $this->searchByEmail($email);
        if (isset($results)) {
            return true;
        } else {
            return false;
        }
    }

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

        //ulozeni do db
        $this->createUser($data['email'], $data['password'], $activationCode);

        $mailsController = new MailsController;
        $mailsController->sendEmailConfirmation($data['email'], $activationCode);

        // return $request->input();
        return redirect('signin?email=' . $email);
    }

    // public function getEmailFromURL(Request $r)
    // {
    //     return $r->input('email');
    // }

    public function searchByEmail($email)
    {
        return DB::table('users')
            ->select('id')
            ->where('email', '=', $email)
            ->value('id');
        // ->get();
    }

    public function getSignInFormData(Request $request)
    {
        // return $request;
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $requestInput = $request->input();
        $email = $requestInput['email'];
        $password = $requestInput['password'];



        $id = $this->searchByEmail($email);

        //    if (count($id) != 1) {
        //        //TODO error
        //    }
        //    $id = $id[0]['id'];

        $user = $this->getById($id);

        if (!$user) {
            return redirect('/signin?email=' . $email . '&error=badEmail');
        }

        // return redirect('?' . $user->password);

        if (!password_verify($password, $user->password)) {
            return redirect('/signin?email=' . $email . '&error=badPassword');
        }

        //    $this->logUserIn();
        // $request->session('user_id', $id);
        session(['user_id' => $id]);
        session(['last_activity' => time()]);
        return redirect('/?info=loginSuccessful');
    }

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
}
