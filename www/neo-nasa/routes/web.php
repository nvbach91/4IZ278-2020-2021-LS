<?php

<<<<<<< HEAD
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

=======
use App\Http\Controllers\GalaxyController;
use App\Http\Controllers\SpaceStationController;

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
>>>>>>> 30c810fa343191f4da02bdecfab49f43a3afa6c2

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD

Route::get('/users', function () {
    // $users = ['Dave', 'Jane', 'Bob'];
    $userController = new UserController();
    $users = $userController->fetchAll();

    return view('users')->with('users', $users);
});
// galaxies
// spacestations

// spacestationsbygalaxy?id=galaxy_id

// galaxy/1
// spacestations/2
=======
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





>>>>>>> 30c810fa343191f4da02bdecfab49f43a3afa6c2
