<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\LogoutController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/auth/register', [RegisterController::class, 'index'])->name('register');
Route::post('/auth/register/store', [RegisterController::class, 'store'])->name('register.store');
Route::get('/auth/login', [LoginController::class, 'index'])->name('login');
Route::post('/auth/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/auth/logout',[LogoutController::class,'store'])->name('logout.store');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('dashboard')->with('success', 'Tu correo fue verificado correctamente.
    Ya puedes crear Presupuestos y Gastos');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'Se ha enviado un nuevo correo de verificación a tu cuenta.');
})->middleware(['auth','throttle:1 ,1'])->name('verification.send');

Route::get('/email/verify', function () {
    return view('Auth.email-verify');
})->middleware('auth')->name('verification.notice');

Route::middleware(['auth','verified'])->group(function(){
    Route::get('/dashboard', [BudgetController::class, 'index'])->name('dashboard');
    Route::get('/budgets/create', [BudgetController::class, 'create'])->name('budgets.create');
});