<?php

use App\Http\Controllers\AuthController;

Route::middleware('auth.session')->group(function () {
    Route::get('/', fn() => view('mobile_home'));
    Route::get('/analytics', fn() => view('pages.analytics'));
    Route::get('/messages', fn() => view('pages.messages'));
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');
