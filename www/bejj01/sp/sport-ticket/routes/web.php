<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::view('/event-detail','pages.event-detail');
Route::get('/ticket-detail/{id}',[TicketController::class, 'showTicket'])->name('show-ticket');
Route::get('/cart', [EventController::class, 'cart'])->name('cart');
Route::get('/profile', [UserController::class, 'show'])->name('profile');
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/buy/{id}', [EventController::class, 'addToCart'])->name('buy');
Route::get('/remove/{id}', [EventController::class, 'removeFromCart'])->name('remove');
Route::get('/purchase', [TicketController::class, 'create'])->name('purchase');
Route::get('/checkout/{total}', [CheckoutController::class, 'index'])->name('checkout');

//Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::post('/login',[LoginController::class, 'login'])->name('login');
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
});
