<?php

use App\Http\Controllers\UserController;
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

Route::get('/galaxies', function () {
    $galaxyController = new GalaxyController();
    $galaxies = $galaxyController->fetchAll();
    return view('galaxies')->with('galaxies', $galaxies);
});

Route::get('/galaxies/{id}', function ($galaxy_id) {
    $galaxyController = new GalaxyController();
    $galaxyById = $galaxyController->fetchById($galaxy_id);
    return view('galaxyById')->with('galaxyById', $galaxyById);
});

Route::get('/galaxies/{id}/spacestations', function ($galaxy_id) {
    $spaceStationController = new SpaceStationController();
    $spaceStations = $spaceStationController->fetchAllSpacestationsByGalaxyId($galaxy_id);
    return view('spaceStations')->with('spaceStations', $spaceStations);
});

Route::get('/spacestations/{spaceStation_id}', function ($spaceStation_id) {
    $spaceStationController = new SpaceStationController();
    $spaceStationById = $spaceStationController->fetchById($spaceStation_id);
    return view('spaceStationById')->with('spaceStationById', $spaceStationById);
});





