<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\ButtonsController;
use App\Http\Controllers\AsideItemsController;
use App\Http\Controllers\PageItemsController;
use App\Http\Controllers\UserController;

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
    // $buttonsController      = new ButtonsController;
    // $asideItemsController   = new AsideItemsController;
    // $usersController        = new UsersController;

    // $buttons                = $buttonsController->getButtons();
    // $asideItems             = $asideItemsController->getAsideItems();
    // $loggedUser             = $usersController->getCurrentUser();

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('homepage') ->with('pageItems', $pageItems)
                            ->with('title', 'Kjepii');
});

// Route::get('/dbtest', function () {
//     return view('dbtest');
// });

// Route::get('/users', function () {
//     $usersController        = new UsersController;
//     $buttonsController      = new ButtonsController;
//     $asideItemsController   = new AsideItemsController;

//     $users                  = $usersController->index();
//     //$buttons                = $buttonsController->getButtons();
//     $asideItems             = $asideItemsController->getAsideItems();

//     $pageItemsController    = new PageItemsController;
//     $pageItems              = $pageItemsController->fetch();

//     return view('users')->with('users', $users)
//         ->with('LoggedUser', 'Logged User: Peta Default')
//         ->with('Button1', $buttons['button1'])
//         ->with('Button2', $buttons['button2'])
//         ->with('asideItems', $asideItems)
//         ->with('title', 'Kjepii');
// });

Route::get('/songs/{song_id}', function ($song_id) {

    // $asideItemsController   = new AsideItemsController;
    $songsController        = new SongsController;
    // $buttonsController      = new ButtonsController;
    // $usersController        = new UsersController;

    // $asideItems             = $asideItemsController->getAsideItems();
    $song                   = $songsController->show($song_id);
    // $buttons                = $buttonsController->getButtons();
    // $loggedUser             = $usersController->getCurrentUser();

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('song')->with('songArray', $song)
        ->with('pageItems', $pageItems)
        // ->with('LoggedUser', $loggedUser['username'])
        // ->with('Button1', $buttons['button1'])
        // ->with('Button2', $buttons['button2'])
        // ->with('asideItems', $asideItems)
        ->with('title', 'Kjepii');
});

// Route::resource('users', 'App\Http\Controllers\UsersController');

Route::get('/profile', function () {

    // $asideItemsController   = new AsideItemsController;
    // $buttonsController      = new ButtonsController;
    // $usersController        = new UsersController;

    // $asideItems             = $asideItemsController->getAsideItems();
    // $buttons                = $buttonsController->getButtons();
    // $loggedUser             = $usersController->getCurrentUser();

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('profile')->with('pageItems', $pageItems)
        ->with('title', 'Kjepii');
});

Route::get('/savedChords', function () {

    // $asideItemsController   = new AsideItemsController;
    // $buttonsController      = new ButtonsController;
    // $usersController        = new UsersController;

    // $asideItems             = $asideItemsController->getAsideItems();
    // $buttons                = $buttonsController->getButtons();
    // $loggedUser             = $usersController->getCurrentUser();

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('savedChords')->with('pageItems', $pageItems)
        // ->with('LoggedUser', $loggedUser['username'])
        // ->with('Button1', $buttons['button1'])
        // ->with('Button2', $buttons['button2'])
        // ->with('asideItems', $asideItems)
        ->with('title', 'SavedChords');
});

Route::get('/createdByMe', function () {

    // $asideItemsController   = new AsideItemsController;
    // $buttonsController      = new ButtonsController;
    // $usersController        = new UsersController;

    // $asideItems             = $asideItemsController->getAsideItems();
    // $buttons                = $buttonsController->getButtons();
    // $loggedUser             = $usersController->getCurrentUser();

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('createdByMe')->with('pageItems', $pageItems)
        // ->with('LoggedUser', $loggedUser['username'])
        // ->with('Button1', $buttons['button1'])
        // ->with('Button2', $buttons['button2'])
        // ->with('asideItems', $asideItems)
        ->with('title', 'Kjepii');
});

Route::get('/search/{query}', function ($query) {
    $songsController        = new SongsController;
    // $buttonsController      = new ButtonsController;
    // $asideItemsController   = new AsideItemsController;
    // $usersController        = new UsersController;

    // $buttons                = $buttonsController->getButtons();
    // $asideItems             = $asideItemsController->getAsideItems();
    $results                = $songsController->searchByQuery($query);
    // $loggedUser             = $usersController->getCurrentUser();

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('homepage')
        ->with('results', $results)
        ->with('pageItems', $pageItems)
        //->with('LoggedUser', $loggedUser['username'])
        //->with('Button1', $buttons['button1'])
        //->with('Button2', $buttons['button2'])
        //->with('asideItems', $asideItems)
        ->with('title', 'Kjepii');
});

Route::redirect('/search', '/');

Route::get('/signup', function() {
    // $asideItemsController   = new AsideItemsController;
    // $buttonsController      = new ButtonsController;
    // $usersController        = new UsersController;

    // $asideItems             = $asideItemsController->getAsideItems();
    // $buttons                = $buttonsController->getButtons();
    // $loggedUser             = $usersController->getCurrentUser();

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('signup')->with('pageItems', $pageItems)
        ->with('title', 'Sign up');
    
});