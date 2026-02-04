<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mobile_home');
});

Route::get('/analytics', function () {
    return view('pages.analytics');
});

Route::get('/messages', function () {
    return view('pages.messages');
});

// Authentication Design Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');
