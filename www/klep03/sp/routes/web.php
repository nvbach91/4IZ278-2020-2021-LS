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
    $pageItems    = new PageItems;
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
Route::get('/songs/{song_id}', function ($song_id, Request $request) {

    $songsController        = new SongsController;
    $song                   = $songsController->show($song_id);

    $pageItems    = new PageItems;
    $pageItems              = $pageItems->fetch();

    if (!$pageItems['anonymous']) {
        $savedSongsController = new SavedSongsController;
        $addedToSaved = $savedSongsController->isAlreadySaved(session('user_id'), $song_id);
    } else {
        $addedToSaved = false;
    }

    $user_ratingsController = new User_ratingsController;
    $ratings = $user_ratingsController->ratingsForSong($song_id);

    $commentsController = new CommentsController;
    $comments           = $commentsController->renderComments($song_id);

    $responding         = $request->input('responding');
    if ($responding) {
        $responseTo     = $request->input('responseTo');
        $previousComment = $commentsController->getById($responseTo);
        $response       = [
            'responding' => $responding,
            'responseTo' => $responseTo,
            'authorName' => $request->input('previousAuthor'),
            'previousContent' => $previousComment->content,
        ];
    } else {
        $response       = [
            'responding' => $responding,
        ];
    }

    return view('song')->with('song', $song)
        ->with('pageItems', $pageItems)
        ->with('addedToSaved', $addedToSaved)
        ->with('ratings', $ratings)
        ->with('commentsFormatted', $comments)
        ->with('response', $response)
        ->with('title', 'Song – ' . $song->name);
});

Route::get('/songs/{song_id}/edit', function ($song_id) {
    $songsController        = new SongsController;
    $song                   = $songsController->show($song_id);

    if ($song->created_by !== session('user_id')) {
        return redirect('/songs/$song_id');
    }

    $pageItems    = new PageItems;
    $pageItems              = $pageItems->fetch();

    return view('songEdit')
        ->with('song', $song)
        ->with('pageItems', $pageItems)
        ->with('title', 'Edit – ' . $song->name);
});

Route::post('/songs/{song_id}/edit', function ($song_id, Request $request) {
    // return $request;
    $songsController        = new SongsController;
    $song                   = $songsController->show($song_id);

    if ($song->created_by !== session('user_id')) {
        return redirect('/songs/$song_id');
    }

    DB::table('songs')
        ->where('id', '=', $song_id)
        ->update([
            'name'              => $request->input('name'),
            'artist'            => $request->input('artist'),
            'lyrics_w_chords'   => $request->input('lyrics_w_chords'),
            'updated_at'        => now(),
        ]);

    return redirect('/createdByMe');
});

Route::get('/newSong', [SongsController::class, 'createNew']);

Route::get('/songs/{song_id}/delete', [SongsController::class, 'delete']);

Route::get('/songs/{song_id}/rate', function ($song_id, Request $request) {
    $user_ratingsController = new User_ratingsController;

    if (null !== $request->input('rating')) {
        $rating = $request->input('rating');
        $user_ratingsController->writeRating($song_id, $rating);
    }
    return redirect('/songs/' . $song_id);
});

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
    $pageItems    = new PageItems;

    $pageItems              = $pageItems->fetch();

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
    $pageItems    = new PageItems;

    $pageItems              = $pageItems->fetch();

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

    $pageItems    = new PageItems;
    $songsController        = new SongsController;
    $savedSongsController   = new SavedSongsController;

    $pageItems              = $pageItems->fetch();

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
    $pageItems    = new PageItems;

    $pageItems              = $pageItems->fetch();

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

    $pageItems    = new PageItems;
    $pageItems              = $pageItems->fetch();

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

        $pageItems    = new PageItems;
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
    $usersController = new UsersController;
    if (!$usersController->isLoggedIn()) {
        $email = $request->input('email');

        $pageItems    = new PageItems;
        $pageItems              = $pageItems->fetch();

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
        return redirect('/signin');
    }
});

Route::post('/email-confirmation/submit', [UsersController::class, 'confirmEmail']);

Route::get('/deleteSession', function (Request $request) {
    session(['user_id' => null]);
});
