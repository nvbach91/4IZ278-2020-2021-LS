<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('homepage')->with('pageItems', $pageItems)
        ->with('title', 'MySongs');
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

    $songsController        = new SongsController;
    $song                   = $songsController->show($song_id);

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('song')->with('songArray', $song)
        ->with('pageItems', $pageItems)
        ->with('title', 'Song – ' . $song[0]->name);
});

// Route::resource('users', 'App\Http\Controllers\UsersController');

Route::get('/profile', function () {

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('profile')->with('pageItems', $pageItems)
        ->with('title', 'Kjepii');
});

Route::get('/savedChords', function () {

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('savedChords')->with('pageItems', $pageItems)
        ->with('title', 'SavedChords');
});

Route::get('/createdByMe', function () {

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('createdByMe')->with('pageItems', $pageItems)
        ->with('title', 'Kjepii');
});

Route::get('/search/{query}', function ($query) {
    $songsController        = new SongsController;
    $results                = $songsController->searchByQuery($query);

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('homepage')
        ->with('results', $results)
        ->with('pageItems', $pageItems)
        ->with('title', 'Kjepii');
});

Route::redirect('/search', '/');

Route::get('/signup', function (Request $request) {
    $customErrorMessage = $request->input('e');
    

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('signup')->with('pageItems', $pageItems)
        ->with('customErrorMessage', $customErrorMessage)
        ->with('title', 'Sign up');
});

Route::get('/signin', function (Request $request) {
    $email = $request->input('email');

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('signin')->with('pageItems', $pageItems)
        ->with('title', 'Sign in')
        ->with('email', $email);
});

// Route::post('/signup/submit', function ($post) {
//     $email = $post["signUpEmail"];
//     $pageItemsController    = new PageItemsController;
//     $pageItems              = $pageItemsController->fetch();

//     return $email;
//     // return view('/signin')
//     //     ->with('pageItems', $pageItems)
//     //     ->with('title', 'Sign up')
//     //     ->with('email', $email);
        
// });

Route::post('/signup/submit', [UsersController::class, 'getSignUpFormData']);

Route::post('/signin/submit', [UsersController::class, 'getSignInFormData']);

Route::get('/test', function() {
    $usersController = new UsersController;

    
     $response = $usersController->searchByEmail('klepetkope@gmail.com');
     return json_encode($response);
});