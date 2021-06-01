<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\ButtonsController;
use App\Http\Controllers\AsideItemsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\MailsController;
// use App\Http\Controllers\PageItemsController;
use App\Http\Controllers\SavedSongsController;
use App\Http\Controllers\User_ratingsController;
use App\Http\Controllers\UserController;
use App\Models\PageItems;
use App\Models\User_rating;
use Illuminate\Support\Facades\DB;

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

/*
|--------------------------------------------------------------------------
| Homepage
|--------------------------------------------------------------------------
|
| 
|
*/

Route::get('/', function () {
    $pageItems              = new PageItems;
    $pageItems              = $pageItems->fetch();

    return view('homepage')->with('pageItems', $pageItems)
        ->with('title', 'MySongs');
});

/*
|--------------------------------------------------------------------------
| Specific Song View 
--------------------------------------------------------------------------
|
| 
|
*/
Route::get('/songs/{song_id}', [SongsController::class, 'getSongDetail']);

Route::get('/songs/{song_id}/edit', [SongsController::class, 'editSong']);

Route::post('/songs/{song_id}/edit', [SongsController::class, 'editSongDataFromForm']);

Route::get('/newSong', [SongsController::class, 'createNew']);

Route::get('/songs/{song_id}/delete', [SongsController::class, 'delete']);

Route::get('/songs/{song_id}/rate', [User_ratingsController::class, 'rate']);

Route::post('/songs/{song_id}/comments/post', [CommentsController::class, 'createNew']);

/*
|--------------------------------------------------------------------------
| Specific Song View 
--------------------------------------------------------------------------
|
| 
|
*/
Route::get('/songs/{song_id}/save', function ($song_id) {
    $pageItems = new PageItems();
    $urlPrefix = $pageItems->getUrlPrefix();

    $savedSongsController = new SavedSongsController;

    $savedSongsController->saveSong($song_id);

    return redirect($urlPrefix . '/songs/' . $song_id);
});

/*
|--------------------------------------------------------------------------
| Specific Song View 
--------------------------------------------------------------------------
|
| 
|
*/
Route::get('/songs/{song_id}/removeFromSaved', function ($song_id) {
    $pageItems = new PageItems();
    $urlPrefix = $pageItems->getUrlPrefix();

    $savedSongsController = new SavedSongsController;

    $savedSongsController->removeSong($song_id);

    return redirect($urlPrefix . '/songs/' . $song_id);
});

// Route::resource('users', 'App\Http\Controllers\UsersController');

/*
|--------------------------------------------------------------------------
| User's Profile
|--------------------------------------------------------------------------
|
| 
|
*/
Route::get('/profile', function () {
    $usersController    = new UsersController;
    $songsController    = new SongsController;
    $pageItems          = new PageItems;

    $pageItems          = $pageItems->fetch();

    if ($usersController->isLoggedIn()) {
        $user = $usersController->getById(session('user_id'));
        $songs = $songsController->searchByUserId(session('user_id'));
        return view('profile')->with('pageItems', $pageItems)
            ->with('user', $user)
            ->with('songs', $songs)
            ->with('title', 'Profile');
    } else {
        return redirect($pageItems['urlPrefix'] . '/signin');
    }
});

/*
|--------------------------------------------------------------------------
| User's Profile – EDIT FORM
|--------------------------------------------------------------------------
|
| 
|
*/
Route::get('/profile/edit', function () {
    $usersController    = new UsersController;
    $songsController    = new SongsController;
    $pageItems          = new PageItems;

    $pageItems          = $pageItems->fetch();

    if ($usersController->isLoggedIn()) {
        $user = $usersController->getById(session('user_id'));
        $songs = $songsController->searchByUserId(session('user_id'));
        return view('profile-edit')->with('pageItems', $pageItems)
            ->with('user', $user)
            ->with('songs', $songs)
            ->with('title', 'Profile');
    } else {
        return redirect($pageItems['urlPrefix'] . '/signin');
    }
});

Route::post('/profile/edit/submit', [UsersController::class, 'updateProfile']);

/*
|--------------------------------------------------------------------------
| User's Saved Chords
|--------------------------------------------------------------------------
|
| 
|
*/
Route::get('/savedChords', function () {

    $pageItems              = new PageItems;
    $songsController        = new SongsController;
    $savedSongsController   = new SavedSongsController;

    $pageItems              = $pageItems->fetch();

    $songs                  = [];
    $userSaves              = $savedSongsController->getSongsFromUser(session('user_id'));
    foreach ($userSaves as $userSave) {
        $song               = $songsController->show($userSave->song_id);
        array_push($songs, $song);
    }

    return view('savedChords')->with('pageItems', $pageItems)
        ->with('songs', $songs)
        ->with('title', 'SavedChords');
});

/*
|--------------------------------------------------------------------------
| Users' Created Chords
|--------------------------------------------------------------------------
|
| 
|
*/
Route::get('/createdByMe', function () {
    $songsController        = new SongsController;
    $usersController        = new UsersController;
    $pageItems              = new PageItems;

    $pageItems              = $pageItems->fetch();

    if ($usersController->isLoggedIn()) {
        $songs              = $songsController->searchByUserId(session('user_id'));
        return view('createdByMe')->with('pageItems', $pageItems)
                            ->with('songs', $songs)
                            ->with('title', 'Created By Me');
    } else {
        return redirect($pageItems['urlPrefix'] .'/signin');
    }
});

/*
|--------------------------------------------------------------------------
| Search results
|--------------------------------------------------------------------------
|
| 
|
*/
Route::get('/search/{query}', function ($query) {
    $songsController        = new SongsController;
    $results                = $songsController->searchByQuery($query);

    $pageItems              = new PageItems;
    $pageItems              = $pageItems->fetch();

    return view('homepage')
        ->with('results', $results)
        ->with('pageItems', $pageItems)
        ->with('title', 'Kjepii');
});

Route::get('/search', function() {
    $pageItems = new PageItems();
    $urlPrefix = $pageItems->getUrlPrefix();

    return redirect($urlPrefix . '/');
});

/*
|--------------------------------------------------------------------------
| Sign Up Form
|--------------------------------------------------------------------------
|
| 
|
*/
Route::get('/signup', function (Request $request) {
    $usersController            = new UsersController;
    if (!$usersController->isLoggedIn()) {
        $customErrorMessage     = $request->input('e');

        $pageItems              = new PageItems;
        $pageItems              = $pageItems->fetch();

        return view('signup')->with('pageItems', $pageItems)
            ->with('customErrorMessage', $customErrorMessage)
            ->with('title', 'Sign up');
    } else {
        return "You are logged in, try reloading the page or signing out.";
    }
});

/*
|--------------------------------------------------------------------------
| Sign In Form
|--------------------------------------------------------------------------
|
| 
|
*/
Route::get('/signin', function (Request $request) {
    $usersController    = new UsersController;
    if (!$usersController->isLoggedIn()) {
        $email = $request->input('email');

        $pageItems      = new PageItems;
        $pageItems      = $pageItems->fetch();

        return view('signin')->with('pageItems', $pageItems)
            ->with('error', $request->input('error'))
            ->with('title', 'Sign in')
            ->with('email', $email);
    }
    return "You are logged in, try reload the page";
});

/*
|--------------------------------------------------------------------------
| Submitted Sign Up Form
|--------------------------------------------------------------------------
|
*/
Route::post('/signup/submit', [UsersController::class, 'getSignUpFormData']);

/*
|--------------------------------------------------------------------------
| Submitted Sign In Form
|--------------------------------------------------------------------------
|
*/
Route::post('/signin/submit', [UsersController::class, 'getSignInFormData']);

/*
|--------------------------------------------------------------------------
| Logout Route
|-------------------------------------------------------------------------- 
|
*/
Route::get('/logout', function () {
    $pageItems = new PageItems();
    $urlPrefix = $pageItems->getUrlPrefix();

    $usersController = new UsersController;
    if ($usersController->isLoggedIn()) {
        $usersController->logOut();
    }
    return redirect($urlPrefix . '/');
});

/*
|--------------------------------------------------------------------------
| Routes For Testing
|--------------------------------------------------------------------------| 
|
*/

Route::get('/test', function (Request $request) {
    $usersController        = new UsersController;
    var_dump($usersController->hasConfirmedEmail(1));
    echo 'ahoj';
});

Route::get('/send-email', [MailsController::class, 'sendMail']);

Route::get('/email-confirmation', function (Request $request) {
    $usersController        = new UsersController;
    $pageItems              = new PageItems;

    $pageItems              = $pageItems->fetch();
    $status = $request->input('status');

    if ($usersController->isLoggedIn()) {
        return view('confirmAccount')->with('pageItems', $pageItems)
            ->with('status', $status)
            ->with('title', 'Confirm E-mail');
    } else {
        return redirect($pageItems['urlPrefix'] . '/signin');
    }
});

Route::post('/email-confirmation/submit', [UsersController::class, 'confirmEmail']);

Route::get('/deleteSession', function (Request $request) {
    session(['user_id' => null]);
});
