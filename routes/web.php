<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchScheduleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StadiumsController;
use App\Http\Controllers\TravelController;
// Add other necessary controller imports here (e.g., Admin controllers, Profile controller)
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group (handles session start, CSRF, etc.).
|
*/

//=================================
// Public Routes (No Auth Needed)
//=================================

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Views & Processing
// Grouping auth routes under a controller is fine
Route::controller(AuthController::class)->group(function () {
    // Show Login Form (Public)
    Route::get('login', 'showLoginForm')->name('login');
    // Process Login Attempt (Public - redirects on success)
    Route::post('login', 'login');
    // Show Registration Form (Public)
    Route::get('register', 'showRegisterForm')->name('register');
    // Process Registration Attempt (Public - redirects on success)
    Route::post('register', 'register');
    // Process Logout - Requires Auth, but often placed here for grouping.
    // The JwtMiddleware will protect it implicitly if accessed directly,
    // or the controller logic handles it if called via a form from an auth'd page.
    Route::post('logout', 'logout')->name('logout');
});

// Publicly viewable content
Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/cities/{city}', [CityController::class, 'show'])->name('cities.show'); // Use a model binding key if applicable

Route::get('/stadiums', [StadiumsController::class, 'index'])->name('stadiums.index');
Route::get('/stadiums/{stadium}', [StadiumsController::class, 'show'])->name('stadiums.show'); // Use a model binding key if applicable

Route::get('/match-schedule', [MatchScheduleController::class, 'index'])->name('match-schedule.index');
Route::get('/match-schedule/{match}', [MatchScheduleController::class, 'show'])->name('match-schedule.show'); // Use a model binding key if applicable

Route::get('/travel', [TravelController::class, 'index'])->name('travel.index');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
// Consider adding a route for individual news articles: Route::get('/news/{article}', [NewsController::class, 'show'])->name('news.show');


//===========================================
// Authenticated Routes (Members and Admins)
//===========================================

// Apply your custom JWT middleware ('jwt.auth') to protect these routes.
// This middleware should check session first, then header, and throw AuthenticationException on failure.
Route::middleware(['jwt.auth'])->group(function () {

    // Member Dashboard (also accessible by Admin by default, unless AdminMiddleware redirects admins)
    Route::get('/member/dashboard', [AuthController::class, 'memberDashboard'])->name('member.dashboard');
    // Favorites Management (Example)
    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
    // Add POST/DELETE routes here for managing favorites
    // Route::post('/favorites/add/{type}/{id}', [FavoritesController::class, 'store'])->name('favorites.store');
    // Route::delete('/favorites/remove/{favorite}', [FavoritesController::class, 'destroy'])->name('favorites.destroy');

    // Example: User Profile Management
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Routes specifically for 'members' if needed (though often covered by the general authenticated group)

});


//=================================
// Admin Only Routes
//=================================

// Apply both JWT authentication AND the Admin role check middleware.
// Grouping with prefix and name is good practice.
Route::middleware(['jwt.auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');

    // Add other admin resource routes here
    // Example:
    // Route::resource('cities', AdminCityController::class); // Assumes you have an AdminCityController
    // Route::resource('stadiums', AdminStadiumController::class);
    // Route::resource('users', AdminUserController::class);
    // Route::resource('articles', AdminNewsController::class);
    // ... etc.

});


//=================================
// Test Routes (Optional)
//=================================
// Keep these commented out or remove them in production.
// If testing authenticated features, apply the relevant middleware.

// Route::get('/test-middleware', function () {
//     return 'Admin Middleware OK';
// })->middleware(['jwt.auth', 'admin']);

// Route::get('/test-session', function () {
//     session()->put('test', 'works');
//     return response()->json([
//         'session_id' => session()->getId(),
//         'test_value' => session('test'),
//         'jwt_token_in_session' => session('jwt_token'), // Useful for debugging
//         'all_session' => session()->all()
//     ]);
// }); // No auth needed for basic session check


//=================================
// Fallback Route (404)
//=================================
Route::fallback(function () {
    // Ensure you have a 'resources/views/errors/404.blade.php' view
    return response()->view('errors.404', [], 404);
});
