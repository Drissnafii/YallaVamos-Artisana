<?php

use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    return view('home');
});

// Main pages
Route::get('/cities', function () {
    return view('cities');
});

Route::get('/stadiums', function () {
    return view('stadiums');
});

Route::get('/match-schedule', function () {
    return view('match-schedule');
});

Route::get('/travel', function () {
    return view('travel');
});

Route::get('/news', function () {
    return view('news');
});

Route::get('/login', function () {
    return view('login');
});

// Dynamic routes
Route::get('/cities/{city}', function ($city) {
    return view('cities', ['city' => $city]);
});

Route::get('/stadiums/{stadium}', function ($stadium) {
    return view('stadiums', ['stadium' => $stadium]);
});

Route::get('/news/{news}', function ($news) {
    return view('news', ['news' => $news]);
});

// 404 fallback
Route::fallback(function () {
    return view('404');
});
