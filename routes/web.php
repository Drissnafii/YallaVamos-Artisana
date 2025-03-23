<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchScheduleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StadiumsController;
use App\Http\Controllers\TravelController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [HomeController::class, 'index']);

// Cities
Route::get('/cities', [CityController::class, 'index']);
Route::get('/cities/{city}', [CityController::class, 'show']);

// Stadiums
Route::get('/stadiums', [StadiumsController::class, 'index'])->name('stadiums.index');
Route::get('/stadiums/{id}', [StadiumsController::class, 'show'])->name('stadiums.show');

Route::get('/match-schedule', [MatchScheduleController::class, 'index'])->name('match-schedule.index');
Route::get('/match-schedule/{id}', [MatchScheduleController::class, 'show'])->name('match-schedule.show');

// routes/web.php
Route::get('/favorites', [FavoritesController::class, 'index'])->name('stadiums.index');
Route::get('/favorites/{id}', [FavoritesController::class, 'show'])->name('stadiums.show');



Route::get('/travel', [TravelController::class, 'index']);

Route::get('/news', [NewsController::class, 'index']);

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

// 404 fallback
Route::fallback(function () {
    return view('errors.404');
});
