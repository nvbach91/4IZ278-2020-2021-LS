<?php

use Illuminate\Support\Facades\Route;
use App\Http\Models;

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
    $offers = DB::select('select o.*, s.NAME as STATUS_NAME from offer o join status s on o.STATUS = s.ID where s.NAME = "Volné" OR s.NAME = "Rezervováno"');
    $statuses = \App\Models\Status::All();
        
    return view('index',[
        'offers' => $offers,
        'statuses' => $statuses,
    ]);
});

Auth::routes();

Route::get('/email', function() {
    return new \App\Mail\NewUserWelcomeMail();
});

Route::get('/offer/create', [App\Http\Controllers\OfferController::class, 'create'])->name('offer.create');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/offer/{offer}', [App\Http\Controllers\OfferController::class, 'show'])->name('offer.show');
Route::get('/offer/{offer}/edit', [App\Http\Controllers\OfferController::class, 'edit'])->name('offer.edit');
Route::get('/offer', [App\Http\Controllers\OfferController::class, 'index'])->name('index');
Route::post('/offer', [App\Http\Controllers\OfferController::class, 'store'])->name('store');
Route::patch('/offer/{offer}', [App\Http\Controllers\OfferController::class, 'update'])->name('offer.update');
Route::patch('/offerReservation/{offer}', [App\Http\Controllers\OfferController::class, 'updateReservation'])->name('offer.update');
Route::patch('/offer/reserve', [App\Http\Controllers\OfferController::class, 'reserve']);
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('index');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::get('/people', [App\Http\Controllers\PeopleController::class, 'index'])->name('index');
