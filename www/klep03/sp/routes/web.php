<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\ButtonsController;
use App\Http\Controllers\AsideItemsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PageItemsController;
use App\Http\Controllers\SavedSongsController;
use App\Http\Controllers\User_ratingsController;
use App\Http\Controllers\UserController;
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
    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

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
Route::get('/songs/{song_id}', function ($song_id) {

    $songsController        = new SongsController;
    $song                   = $songsController->show($song_id);

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    if (!$pageItems['anonymous']) {
        $savedSongsController = new SavedSongsController;
        $addedToSaved = $savedSongsController->isAlreadySaved(session('user_id'), $song_id);
    } else {
        $addedToSaved = false;
    }

    $user_ratingsController = new User_ratingsController;
    $ratings = $user_ratingsController->ratingsForSong($song_id);

    $commentsController = new CommentsController;
    $comments           = $commentsController->renderComments();

    return view('song')->with('song', $song)
        ->with('pageItems', $pageItems)
        ->with('addedToSaved', $addedToSaved)
        ->with('ratings', $ratings)
        ->with('commentsFormatted', $comments)
        ->with('title', 'Song – ' . $song->name);
});

Route::get('/songs/{song_id}/rate', function ($song_id, Request $request) {
    $user_ratingsController = new User_ratingsController;

    if (null !== $request->input('rating')) {
        $rating = $request->input('rating');
        $user_ratingsController->writeRating($song_id, $rating);
    }
    return redirect('/songs/' . $song_id);
});

/*
|--------------------------------------------------------------------------
| Specific Song View 
--------------------------------------------------------------------------
|
| 
|
*/
Route::get('/songs/{song_id}/save', function ($song_id) {
    $savedSongsController = new SavedSongsController;

    $savedSongsController->saveSong($song_id);

    return redirect('/songs/' . $song_id);
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
    $savedSongsController = new SavedSongsController;

    $savedSongsController->removeSong($song_id);

    return redirect('/songs/' . $song_id);
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
    $usersController = new UsersController;
    $songsController = new SongsController;
    $pageItemsController    = new PageItemsController;

    $pageItems              = $pageItemsController->fetch();

    if ($usersController->isLoggedIn()) {
        $user = $usersController->getById(session('user_id'));
        $songs = $songsController->searchByUserId(session('user_id'));
        return view('profile')->with('pageItems', $pageItems)
            ->with('user', $user)
            ->with('songs', $songs)
            ->with('title', 'Profile');
    } else {
        return redirect('/signin');
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
    $usersController        = new UsersController;
    $songsController        = new SongsController;
    $pageItemsController    = new PageItemsController;

    $pageItems              = $pageItemsController->fetch();

    if ($usersController->isLoggedIn()) {
        $user = $usersController->getById(session('user_id'));
        $songs = $songsController->searchByUserId(session('user_id'));
        return view('profile-edit')->with('pageItems', $pageItems)
            ->with('user', $user)
            ->with('songs', $songs)
            ->with('title', 'Profile');
    } else {
        return redirect('/signin');
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

    $pageItemsController    = new PageItemsController;
    $songsController        = new SongsController;
    $savedSongsController   = new SavedSongsController;

    $pageItems              = $pageItemsController->fetch();

    $songs                  = [];
    $userSaves              = $savedSongsController->getSongsFromUser(session('user_id'));
    foreach ($userSaves as $userSave) {
        $song = $songsController->show($userSave->song_id);
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
    $pageItemsController    = new PageItemsController;

    $pageItems              = $pageItemsController->fetch();

    if ($usersController->isLoggedIn()) {
        $songs = $songsController->searchByUserId(session('user_id'));
        return view('createdByMe')->with('pageItems', $pageItems)
            ->with('songs', $songs)
            ->with('title', 'Created By Me');
    } else {
        return redirect('/signin');
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

    $pageItemsController    = new PageItemsController;
    $pageItems              = $pageItemsController->fetch();

    return view('homepage')
        ->with('results', $results)
        ->with('pageItems', $pageItems)
        ->with('title', 'Kjepii');
});

Route::redirect('/search', '/');

/*
|--------------------------------------------------------------------------
| Sign Up Form
|--------------------------------------------------------------------------
|
| 
|
*/
Route::get('/signup', function (Request $request) {
    $usersController = new UsersController;
    if (!$usersController->isLoggedIn()) {
        $customErrorMessage = $request->input('e');

        $pageItemsController    = new PageItemsController;
        $pageItems              = $pageItemsController->fetch();

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
    $usersController = new UsersController;
    if (!$usersController->isLoggedIn()) {
        $email = $request->input('email');

        $pageItemsController    = new PageItemsController;
        $pageItems              = $pageItemsController->fetch();

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
    $usersController = new UsersController;
    if ($usersController->isLoggedIn()) {
        $usersController->logOut();
    }
    return redirect('/');
});

/*
|--------------------------------------------------------------------------
| Routes For Testing
|--------------------------------------------------------------------------| 
|
*/

Route::get('/test', function (Request $request) {
    $usersController = new UsersController;
    // $response = $usersController->searchByEmail('klepetkope@gmail.com');
    // return json_encode($response);
    // $request->session()->put('user_id', 2);

    // $data = $request->session()->all();

    // session(['last_activity' => now()]);
    // return "last_activity = " . strtotime(session('last_activity')) . 
    // "time() = " . time() .
    // (strtotime(session('last_activity')) - time())   ."";

    // $last_activity  = intval(session('last_activity'));
    // $time           = intval(time());
    // $difference     = $time - $last_activity;
    // echo $difference;

    // $usersController->searchByEmail('kjepii@kjepii.cz');
    // $id = $usersController->searchByEmail('ahoj@ahoj.ahoj');
    // echo 'id: ' . $id; 
    // $password =  DB::table('users')->find($id)->password;
    // echo 'password: ' . $password;

    // $results = DB::table('songs')->where('created_by', 1)->get();
    // var_dump($result

    // $usersController = new UsersController;
    // $songsController = new SongsController;

    // $pageItemsController    = new PageItemsController;
    // $pageItems              = $pageItemsController->fetch();

    // if ($usersController->isLoggedIn()) {
    //     $user = $usersController->getById(session('user_id'));
    //     $songs = $songsController->searchByUserId(session('user_id'));
    //     // var_dump($user);
    //     echo $songs[0]->name;
    // } else {
    //     return redirect('/signin');
    // }

    $savedSongsController = new SavedSongsController;

    $user_id = 2;
    $song_id = 3;

    //    var_dump($savedSongsController->isAlreadySaved($user_id, $song_id)); 

    $results = DB::table('user_saved_songs')
        ->where('user_id', $user_id)
        ->where('song_id', $song_id)
        ->get();

    // return $savedSongsController->isAlreadySaved($user_id, $song_id);
    // return $savedSongsController->getSongsFromUser($user_id);

    $user_ratingsController = new User_ratingsController;
    // // echo 
    // echo DB::table('user_ratings')
    // ->where('song', 1)
    // // ->avg('stars');
    // echo 'Rating is ' . $user_ratingsController->getRating(1);
    // echo 'How many people voted: ' . $user_ratingsController->countRatings(1);
    // $specificRating = $user_ratingsController->findSpecificRating(1, 2);
    // echo $specificRating[0]->id;

    $commentsController = new CommentsController;
    echo $commentsController->renderComments();
});

Route::get('/deleteSession', function (Request $request) {
    session(['user_id' => null]);
});
