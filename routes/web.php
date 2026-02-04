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
