<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\FlashcardCollectionController;
use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\FlashcardQuestionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, "index"])->name("index");

Route::get("/login", [AuthenticationController::class, "login"])->name("login");
Route::get("/login/callback", [AuthenticationController::class, "callback"])->name("login.callback");
Route::get("/logout", [AuthenticationController::class, "logout"])->name("logout");

Route::middleware("auth")->group(function () {
    Route::get('/home', [HomeController::class, "homepage"])->name("homepage");
});


Route::resource("collections", FlashcardCollectionController::class);
Route::resource("collections.flashcards", FlashcardController::class)->except("index");
Route::resource("collections.flashcards.questions", FlashcardQuestionController::class)->except("index", "show");

Route::get("/collections/{collection}/flashcards/{flashcard}/practice", [FlashcardController::class, "practice"])->name("collections.flashcards.practice");

Route::post("/collections/{collection}/favorite", [FavoritesController::class, 'favoriteCollection'])->name("collections.favorite");
Route::post("/collections/{collection}/unfavorite", [FavoritesController::class, 'unfavoriteCollection'])->name("collections.unfavorite");

Route::post("/collections/{collection}/flashcards/{flashcard}/favorite", [FavoritesController::class, "favoriteFlashcard"])->name("collections.flashcards.favorite");
Route::post("/collections/{collection}/flashcards/{flashcard}/unfavorite", [FavoritesController::class, "unfavoriteFlashcard"])->name("collections.flashcards.unfavorite");
