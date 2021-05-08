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

Route::get('/', function () {
    return view('welcome');
});


Router::get('/galaxies', function() {
    return view('galaxies', ['galaxies' => GalaxyController::fetchAll()]);
});

Router::get('/galaxies/{id}', function($id) {
    return view('galaxyDetail', ['galaxy' => GalaxyController::fetchById($id)]);
});

Router::get('/spacestations', function() {
    return view('spacestations', ['stations' => SpaceStationController::fetchAll()]);
});

Router::get('/spacestations/{id}', function($id) {
    return view('spacestationDetail', ['station' => SpaceStationController::fetchByGalaxyId($id)]);
});

