<?php

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
    return view('welcome');
});
//Route::get('profile', function () {
//    return view('profile');
//});

Auth::routes();

//Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Profile
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');


//Service
Route::get('/service', [App\Http\Controllers\ServiceController::class, 'index'])->name('service.index');
Route::get('/service/create', [App\Http\Controllers\ServiceController::class, 'create'])->name('service.create');
Route::post('/service/create', [App\Http\Controllers\ServiceController::class, 'createForm'])->name('service.create');
Route::get('/service/{id}', [App\Http\Controllers\ServiceController::class, 'info'])->name('service.info');
