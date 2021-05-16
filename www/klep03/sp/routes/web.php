<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\ButtonsController;
use App\Http\Controllers\AsideItemsController;

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
    $buttonsController      = new ButtonsController;
    $asideItemsController   = new AsideItemsController;

    $buttons                = $buttonsController->getButtons();
    $asideItems             = $asideItemsController->getAsideItems();

    return view('homepage') ->with('LoggedUser', 'Logged User: Peta Default')
                            ->with('Button1', $buttons['button1'])
                            ->with('Button2', $buttons['button2'])
                            ->with('asideItems', $asideItems);;
    });

Route::get('/dbtest', function () {
    return view('dbtest');
});

Route::get('/users', function () {
    $usersController        = new UsersController;
    $buttonsController      = new ButtonsController;
    $asideItemsController   = new AsideItemsController;

    $users                  = $usersController->index();
    $buttons                = $buttonsController->getButtons();
    $asideItems             = $asideItemsController->getAsideItems();

    return view('users')    ->with('users', $users)
                            ->with('LoggedUser', 'Logged User: Peta Default')
                            ->with('Button1', $buttons['button1'])
                            ->with('Button2', $buttons['button2'])
                            ->with('asideItems', $asideItems);
});

Route::get('/songs/{song_id}', function ($song_id) {

    $asideItemsController   = new AsideItemsController;
    $songsController        = new SongsController;
    $buttonsController      = new ButtonsController;

    $asideItems             = $asideItemsController->getAsideItems();
    $song                   = $songsController->show($song_id);
    $buttons                = $buttonsController->getButtons();

    return view('song')     ->with('songArray', $song)
                            ->with('LoggedUser', 'Logged User: Peta Default')
                            ->with('Button1', $buttons['button1'])
                            ->with('Button2', $buttons['button2'])
                            ->with('asideItems', $asideItems);
});

// Route::resource('users', 'App\Http\Controllers\UsersController');

Route::get('/profile', function () {

    $asideItemsController   = new AsideItemsController;
    $buttonsController      = new ButtonsController;

    $asideItems             = $asideItemsController->getAsideItems();
    $buttons                = $buttonsController->getButtons();

    return view('profile')  ->with('LoggedUser', 'Logged User: Peta Default')
                            ->with('Button1', $buttons['button1'])
                            ->with('Button2', $buttons['button2'])
                            ->with('asideItems', $asideItems);
});

Route::get('/savedChords', function () {

    $asideItemsController   = new AsideItemsController;
    $buttonsController      = new ButtonsController;

    $asideItems             = $asideItemsController->getAsideItems();
    $buttons                = $buttonsController->getButtons();

    return view('savedChords')  ->with('LoggedUser', 'Logged User: Peta Default')
                            ->with('Button1', $buttons['button1'])
                            ->with('Button2', $buttons['button2'])
                            ->with('asideItems', $asideItems);
});

Route::get('/createdByMe', function () {

    $asideItemsController   = new AsideItemsController;
    $buttonsController      = new ButtonsController;

    $asideItems             = $asideItemsController->getAsideItems();
    $buttons                = $buttonsController->getButtons();

    return view('createdByMe')  ->with('LoggedUser', 'Logged User: Peta Default')
                            ->with('Button1', $buttons['button1'])
                            ->with('Button2', $buttons['button2'])
                            ->with('asideItems', $asideItems);
});