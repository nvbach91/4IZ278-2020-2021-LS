<?php

    use App\Http\Controllers\AuthenticationController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\EventController;
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

    Route::get('/', [DashboardController::class, 'index'])->name("index");
    Route::get('/login', [AuthenticationController::class, "login"])->name("login");
    Route::get('/login/callback', [AuthenticationController::class, "callback"])->name("callback");
    Route::get("/logout", [AuthenticationController::class, "logout"])->name("logout");

    Route::middleware("auth")->group(function () {
        Route::get('/dashboard', [DashboardController::class, "dashboard"])->name("dashboard");
    });

    Route::post('/events', [EventController::class, "store"])->name("store");
    Route::post('/events/{id}/participate', [EventController::class, "participate"])->name("participate");
    Route::post('/events/{id}/leave', [EventController::class, "leave"])->name("leave");
    Route::post('/events/join', [EventController::class, "join"])->name("join");
    Route::resource('/events', EventController::class)->except("index");
