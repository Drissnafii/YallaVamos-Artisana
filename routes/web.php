<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatcheController;
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
Route::get('/matches', [MatcheController::class, 'index'])->name('matches.index');
Route::get('/matches/{match}', [MatcheController::class, 'show'])->name('matches.show');

// Travel and News
Route::get('/travel', [TravelController::class, 'index'])->name('travel.index');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');

Route::get('/accommodations', function () {
    // You can return a view, redirect, or any other response here
    return view('accommodations.index'); // Assuming you have a view named 'accommodations.index'
})->name('accommodations.index');

Route::post('/newsletter/subscribe', [NewsController::class, 'subscribe'])->name('newsletter.subscribe');

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
    Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('dashboard');


    // Individual article routes
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

//=================================
// Fallback Route (404)
//=================================

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});


// Routes pour la réinitialisation de mot de passe
Route::get('forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->middleware('guest')->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');
Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'reset'])->middleware('guest')->name('password.update');
