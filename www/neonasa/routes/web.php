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

Route::get('/', function () { return redirect()->to("g/galaxies"); });

Route::get('/galaxies', function() {
    return view('galaxies', ['galaxies' => (new GalaxyController())->fetchAll()]);
});

Route::get('/galaxies/{id}', function($id) {
    return view('galaxyDetail', ['galaxy' => (new GalaxyController())->fetchById($id)]);
});

Route::get('/spacestations', function() {
    return view('spacestations', ['stations' => (new SpaceStationController())->fetchAll()]);
});

Route::get('/spacestations/{id}', function($id) {
    return view('spacestationDetail', ['station' => (new SpaceStationController())->fetchByGalaxyId($id)]);
});