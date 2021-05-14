<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/users', function () {
    // $users = ['Dave', 'Jane', 'Bob'];
    $userController = new UserController();
    $users = $userController->fetchAll();

    return view('users')->with('users', $users);
});
// galaxies
// spacestations

// spacestationsbygalaxy?id=galaxy_id

// galaxy/1
// spacestations/2