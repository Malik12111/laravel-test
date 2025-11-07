<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);

// Football Academy Routes
Route::resource('teams', TeamController::class);
Route::resource('players', PlayerController::class);
Route::resource('fixtures', FixtureController::class);
Route::resource('leagues', LeagueController::class);
