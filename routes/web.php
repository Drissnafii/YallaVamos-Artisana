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

// Home page
Route::get('/', [HomeController::class, 'index']);

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

// Public Routes
Route::get('/cities', [CityController::class, 'index']);
Route::get('/cities/{city}', [CityController::class, 'show']);

Route::get('/stadiums', [StadiumsController::class, 'index'])->name('stadiums.index');
Route::get('/stadiums/{id}', [StadiumsController::class, 'show'])->name('stadiums.show');

Route::get('/match-schedule', [MatchScheduleController::class, 'index'])->name('match-schedule.index');
Route::get('/match-schedule/{id}', [MatchScheduleController::class, 'show'])->name('match-schedule.show');

Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
Route::get('/favorites/{id}', [FavoritesController::class, 'show'])->name('favorites.show');

Route::get('/travel', [TravelController::class, 'index']);
Route::get('/news', [NewsController::class, 'index']);

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // User Dashboard
    Route::get('/dashboard', [AuthController::class, 'userDashboard'])
        ->name('dashboard');
});


Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])
        ->name('admin.dashboard');
});




// 404 fallback
Route::fallback(function () {
    return view('errors.404');
});

Route::get('/test-middleware', function () {
    return 'OK';
})->middleware('admin');
