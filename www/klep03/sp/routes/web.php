<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SongsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::get('/dbtest', function () {
    return view('dbtest');
});

Route::get('/users', function () {
    $usersController = new UsersController;
    $users = $usersController->index();

    $asideItems = [
        'My Profile' => '/profile',
        'Saved Chords' => '/savedChords',
        'Created By Me' => '/createdByMe',
    ];

    return view('users')->with('users', $users)
        ->with('LoggedUser', 'Logged User: Peta Default')
        ->with('Button1', 'Sign Up')
        ->with('Button2', 'Sign In')
        ->with('asideItems', $asideItems);
});

Route::get('/songs/{song_id}', function ($song_id) {
    $asideItems = [
        'My Profile' => '/profile',
        'Saved Chords' => '/savedChords',
        'Created By Me' => '/createdByMe',
    ];
    $songsController = new SongsController;
    $song = $songsController->show($song_id);
    return view('song')
        ->with('songArray', $song)
        ->with('LoggedUser', 'Logged User: Peta Default')
        ->with('Button1', 'Sign Up')
        ->with('Button2', 'Sign In')
        ->with('asideItems', $asideItems);
});

// Route::resource('users', 'App\Http\Controllers\UsersController');