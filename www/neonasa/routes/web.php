<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GalaxyController;
use App\Http\Controllers\SpaceStationController;

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

Route::get('/', fn () => redirect()->route('galaxies.index'));

Route::get('/galaxies', [GalaxyController::class, 'index'])->name('galaxies.index');
Route::get('/galaxy/{id}', [GalaxyController::class, 'show'])->name('galaxies.show');

Route::get('/space-stations', [SpaceStationController::class, 'index'])->name('space-stations.index');
Route::get('/space-stations/{id}', [SpaceStationController::class, 'show'])->name('space-stations.show');