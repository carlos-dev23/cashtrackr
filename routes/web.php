<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/register', function () {
    return view('Auth.register');
});

Route::get('/auth/login', function () {
    return view('Auth.login');
});