<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Auth\Events\Login;
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

// routes available without login
Route::redirect('/', 'home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

//region events
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events/get', [EventController::class, 'getFetched'])->name('ordered');
Route::get('/events/fetch', [EventController::class, 'fetchData'])->name('fetch');
Route::get('/events/{id}',[EventController::class, 'showDetail'])->whereNumber('id')->name('event-detail');
Route::get('/events/create', [EventController::class, 'createEvent'])->name('event.create')->middleware('admin');
Route::post('/events/create/do', [EventController::class, 'doCreate'])->name('event.create.do')->middleware('admin');
Route::post('/events/{id}/delete', [EventController::class, 'deleteEvent'])->whereNumber('id')->name('event.delete')->middleware('admin');
Route::post('/events/{id}/edit/do', [EventController::class, 'doEdit'])->whereNumber('id')->name('event.edit.do')->middleware('admin');
Route::get('/events/{id}/edit', [EventController::class, 'editEvent'])->whereNumber('id')->name('event.edit')->middleware('admin');
//endregion

//region sports
Route::get('/sports', [SportController::class, 'index'])->name('sports');
Route::post('/sports/create', [SportController::class, 'createSport'])->name('sport.create')->middleware('admin');;
Route::post('/sports/{id}/update', [SportController::class, 'updateSport'])->name('sport.update')->middleware('admin');;
Route::post('/sports/{id}/delete', [SportController::class, 'deleteSport'])->name('sport.delete')->middleware('admin');;
Route::get('/sports/{sport}/favorite', [SportController::class, 'favoriteSport'])->name('favorite')->middleware('auth');
//endregion

Route::get('/login', [LoginController::class, 'index'])->name('login-form');
Route::get('/register', [RegisterController::class, 'index'])->name('register-form');
Route::get('/unauthenticated', [LoginController::class, 'redirectToLogin'])->name('unauth');

// routes available only after login
//region profile
Route::get('/profile', [UserController::class, 'show'])->name('profile')->middleware('auth');
Route::post('/profile/change_password', [UserController::class, 'changePassword'])->name('password')->middleware('auth');
Route::post('/profile/change_username', [UserController::class, 'changeUsername'])->name('username')->middleware('auth');
Route::post('/profile/change_email', [UserController::class, 'changeEmail'])->name('email')->middleware('auth');
//endregion

Route::get('/ticket-detail/{id}',[TicketController::class, 'showTicket'])->whereNumber('id')->name('show-ticket')->middleware('auth');
Route::get('/ticket-detail/{id}/pdf',[TicketController::class, 'createPDF'])->whereNumber('id')->name('ticket-pdf')->middleware('auth');

//region cart
Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware('auth');
Route::get('/cart/empty', [CartController::class, 'emptyCart'])->name('cart.empty')->middleware('auth');
Route::get('/cart/checkout/{total}', [CheckoutController::class, 'index'])->name('checkout')->middleware('auth');
Route::get('/buy/{id}', [CartController::class, 'add'])->name('buy')->whereNumber('id')->middleware('auth');
Route::get('/remove/{id}', [CartController::class, 'remove'])->whereNumber('id')->name('remove')->middleware('auth');
Route::post('/cart/purchase', [TicketController::class, 'create'])->name('purchase')->middleware('auth');
Route::post('/cart/update', [CartController::class, 'changeEventNumber'])->name('update-cart')->middleware('auth');
//endregion

Route::namespace('Auth')->group(function () {
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
});

//OAuth socialite routes
Route::get('/login/{service}', [LoginController::class, 'authRedirect'])->name('login.service');
Route::get('/login/{service}/callback', [LoginController::class, 'authServiceCallback'])->name('login.callback');
