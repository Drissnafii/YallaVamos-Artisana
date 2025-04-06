<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchScheduleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StadiumsController;
use App\Http\Controllers\TravelController;
use Illuminate\Support\Facades\Route;

//=================================
// Public Routes (No Authentication Required)
//=================================

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');
    Route::get('register', 'showRegisterForm')->name('register');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->name('logout');
});

// Cities and Stadiums
Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/cities/{city}', [CityController::class, 'show'])->name('cities.show');

Route::get('/stadiums', [StadiumsController::class, 'index'])->name('stadiums.index');
Route::get('/stadiums/{stadium}', [StadiumsController::class, 'show'])->name('stadiums.show');

// Match Schedule
Route::get('/match-schedule', [MatchScheduleController::class, 'index'])->name('match-schedule.index');
Route::get('/match-schedule/{match}', [MatchScheduleController::class, 'show'])->name('match-schedule.show');

// Travel and News
Route::get('/travel', [TravelController::class, 'index'])->name('travel.index');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');

//=================================
// Authenticated Routes
//=================================

Route::middleware(['auth'])->group(function () {
    // Member Dashboard
    Route::get('/member/dashboard', [AuthController::class, 'memberDashboard'])->name('member.dashboard');

    // Favorites Management
    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
    // Add POST and DELETE routes for favorites if required
});

//=================================
// Admin Routes
//=================================

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');

});

//=================================
// Fallback Route (404)
//=================================

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
