<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatcheController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PublicCityController;
use App\Http\Controllers\PublicStadiumController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\Admin\ProfileController;
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

// Public Cities Routes
Route::get('/cities', [PublicCityController::class, 'index'])->name('cities.index');
Route::get('/cities/{city}', [PublicCityController::class, 'show'])->name('cities.show');


Route::get('/stadiums', [PublicStadiumController::class, 'index'])->name('stadiums.index');
Route::get('/stadiums/{stadium}', [PublicStadiumController::class, 'show'])->name('stadiums.show');

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
    // Admin Dashboard
    Route::get('dashboard', [AuthController::class, 'adminDashboard'])->name('dashboard');

    // Admin Profile Management
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    // Articles Management
    Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Toggle Article Status
    Route::patch('articles/{article}/toggle-status', [ArticleController::class, 'toggleStatus'])->name('articles.toggle-status');

    // Categories Management
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Stadiums Management
    Route::get('stadiums', [StadiumController::class, 'index'])->name('stadiums.index');
    Route::get('stadiums/create', [StadiumController::class, 'create'])->name('stadiums.create');
    Route::post('stadiums', [StadiumController::class, 'store'])->name('stadiums.store');
    Route::get('stadiums/{stadium}', [StadiumController::class, 'show'])->name('stadiums.show');
    Route::get('stadiums/{stadium}/edit', [StadiumController::class, 'edit'])->name('stadiums.edit');
    Route::put('stadiums/{stadium}', [StadiumController::class, 'update'])->name('stadiums.update');
    Route::delete('stadiums/{stadium}', [StadiumController::class, 'destroy'])->name('stadiums.destroy');

    // Cities Management
    Route::get('cities', [CityController::class, 'index'])->name('cities.index');
    Route::get('cities/create', [CityController::class, 'create'])->name('cities.create');
    Route::post('cities', [CityController::class, 'store'])->name('cities.store');
    Route::get('cities/{city}', [CityController::class, 'show'])->name('cities.show');
    Route::get('cities/{city}/edit', [CityController::class, 'edit'])->name('cities.edit');
    Route::put('cities/{city}', [CityController::class, 'update'])->name('cities.update');
    Route::delete('cities/{city}', [CityController::class, 'destroy'])->name('cities.destroy');

    // Accommodations Management
    Route::get('accommodations', [AccommodationController::class, 'index'])->name('accommodations.index');
    Route::get('accommodations/create', [AccommodationController::class, 'create'])->name('accommodations.create');
    Route::post('accommodations', [AccommodationController::class, 'store'])->name('accommodations.store');
    Route::get('accommodations/{accommodation}', [AccommodationController::class, 'show'])->name('accommodations.show');
    Route::get('accommodations/{accommodation}/edit', [AccommodationController::class, 'edit'])->name('accommodations.edit');
    Route::put('accommodations/{accommodation}', [AccommodationController::class, 'update'])->name('accommodations.update');
    Route::delete('accommodations/{accommodation}', [AccommodationController::class, 'destroy'])->name('accommodations.destroy');

    // Matches Management
    Route::get('matches', [MatcheController::class, 'index'])->name('matches.index');
    Route::get('matches/create', [MatcheController::class, 'create'])->name('matches.create');
    Route::post('matches', [MatcheController::class, 'store'])->name('matches.store');
    Route::get('matches/{match}', [MatcheController::class, 'show'])->name('matches.show');
    Route::get('matches/{match}/edit', [MatcheController::class, 'edit'])->name('matches.edit');
    Route::put('matches/{match}', [MatcheController::class, 'update'])->name('matches.update');
    Route::delete('matches/{match}', [MatcheController::class, 'destroy'])->name('matches.destroy');

    // Teams Management
    Route::get('teams', [TeamController::class, 'index'])->name('teams.index');
    Route::get('teams/create', [TeamController::class, 'create'])->name('teams.create');

    // Users Management
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::post('teams', [TeamController::class, 'store'])->name('teams.store');
    Route::get('teams/{team}', [TeamController::class, 'show'])->name('teams.show');
    Route::get('teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');
    Route::put('teams/{team}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');

    // AI Chat Interface
    Route::get('chat', function () {
        return view('dashboard.admin.chat.index');
    })->name('chat');
});

//=================================
// Test Route (For Development)
//=================================

Route::get('/test-category', function () {
    return \App\Models\Category::create([
        'name' => 'Test Category',
        'slug' => 'test-category',
        'description' => 'This is a test category'
    ]);
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


// ChatBoot

Route::post('/chatbot-query', [ChatbotController::class, 'handleQuery'])->name('chatbot.query');
