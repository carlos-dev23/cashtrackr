<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/auth/register', function () {
    return view('Auth.register');
})->name('register');

Route::get('/auth/login', function () {
    return view('Auth.login');
})->name('login');