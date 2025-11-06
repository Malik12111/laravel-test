<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\LeagueController;

Route::get('/', function () {
    return view('welcome');
});

// Football Academy Routes
Route::resource('teams', TeamController::class);
Route::resource('players', PlayerController::class);
Route::resource('fixtures', FixtureController::class);
Route::resource('leagues', LeagueController::class);
