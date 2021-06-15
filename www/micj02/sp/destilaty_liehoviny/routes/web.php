<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LiquorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Mail\OrderMail;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [LiquorController::class, 'index'])->name('liquor.index');
Route::get('/liquor/{liquor}', [LiquorController::class, 'show'])->name('liquor.show');

Route::post('add-to-cart/{liquor}', [CartController::class, 'add_to_cart'])->name('cart.add_to_cart');
Route::post('remove-from-cart/{liquor}', [CartController::class, 'remove_from_cart'])->name('cart.remove_from_cart');

Route::get('/cart/edit', [CartController::class, 'edit'])->name('cart.edit');

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::post('/o', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/{order}', [OrderController::class, 'show'])->middleware(['auth'])->name('order.show');

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/email', function () {
    return new OrderMail(\App\Models\Order::first());
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();
