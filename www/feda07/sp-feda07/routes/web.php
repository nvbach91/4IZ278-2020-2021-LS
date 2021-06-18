<?php

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

Route::get('/', function () {
    if (Auth::guest()) {
        return view('welcome');
    }
    return redirect('home');
});
//Route::get('profile', function () {
//    return view('profile');
//});

Auth::routes();

//Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//About us
Route::get('/information', [App\Http\Controllers\InformationController::class, 'info'])->name('information');

//Profile
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'editView'])->name('profile.edit');
Route::post('/profile/edit/post', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit.post');
Route::post('/profile/reservation', [App\Http\Controllers\ProfileController::class, 'delete'])->name('profile.reservation.delete');


//Service
Route::get('/service', [App\Http\Controllers\ServiceController::class, 'index'])->name('service.index');
Route::get('/service/create', [App\Http\Controllers\ServiceController::class, 'create'])->name('service.create');
Route::post('/service/create', [App\Http\Controllers\ServiceController::class, 'createForm'])->name('service.create');
Route::get('/service/{id}', [App\Http\Controllers\ServiceController::class, 'info'])->name('service.info');
Route::get('/service/{id}/{date}', [App\Http\Controllers\ServiceController::class, 'getAvailableDays'])->name('service.getAvailableDays');
Route::post('/service/reserve', [App\Http\Controllers\ServiceController::class, 'makeReservation'])->name('service.reserve');
Route::post('/service/delete', [App\Http\Controllers\ServiceController::class, 'delete'])->name('service.delete');
Route::get('/services/edit/{id}', [App\Http\Controllers\ServiceController::class, 'editView'])->name('service.edit');
Route::post('/services/edit/{id}', [App\Http\Controllers\ServiceController::class, 'edit'])->name('service.edit.post');

