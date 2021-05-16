<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LiquorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserAddressController;
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

Route::get('/{user}/cart/edit', [CartController::class, 'edit'])->name('cart.edit');
Route::patch('/{user}/cart/edit', [CartController::class, 'update'])->name('cart.update');

Route::get('/{user}/address/edit', [UserAddressController::class, 'edit'])->name('address.edit');
Route::patch('/{user}/address', [UserAddressController::class, 'update'])->name('address.update');

Route::get('/{user}/order', [OrderController::class, 'order.index']);
Route::get('/{user}/order/create', [OrderController::class, 'order.create']);
Route::post('/{user}/order', [OrderController::class, 'order.store']);
Route::get('/{user}/order/{order}', [OrderController::class, 'order.show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
