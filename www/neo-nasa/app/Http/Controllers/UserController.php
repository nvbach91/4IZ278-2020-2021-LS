<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\User;

class UserController extends Controller {
    public function fetchAll() {
        $results = User::all();
        return $results;
    }
    public function fetchById($id) {

    }
    public function fetchAllByGalaxyId($id) {
        
=======
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{

    public function fetchAll() {
       return 'user' => User::all();
    }

    public function fetchById($id)
    {
        'user' => User::findOrFail($id)
    }

    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
>>>>>>> 30c810fa343191f4da02bdecfab49f43a3afa6c2
    }
}
