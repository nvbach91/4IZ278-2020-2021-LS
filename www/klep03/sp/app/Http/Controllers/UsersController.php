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
        DB::table('users')-> insert([$request]);
    }

    public function storeDefault($request)
    {
        DB::table('users')-> insert([$request]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    private function createUser($email, $password) {
        $hashedPassword = $this->hashPassword($password);
        $dbData = [
            'email' => $email,
            'password' => $hashedPassword,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $this->storeDefault($dbData);
    }

    function hashPassword($password) {
        //TO be implemented
        return $password;
    }

    function getSignUpFormData(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required | min:8',
            'confirmPassword' => 'required | same:password',
        ]);
        $data = $request->input();

        //ulozeni do db
        $this->createUser($data['email'], $data['password']);

        $email = $data['email'];
        // return $request->input();
        return redirect('signin?email=' . $email);
    }

    public function getEmailFromURL(Request $r) {
        return $r->input('email');
    }

    public function searchByEmail($email) {
        return DB::table('users')
            ->select('id')
            ->where('email', '=', $email)
            ->get();
    }
}
