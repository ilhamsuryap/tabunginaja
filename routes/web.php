<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
| Hanya bisa diakses oleh user yang belum login.
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    Route::get('/login', [
        AuthController::class,
        'showLogin'
    ])->name('login');

    Route::post('/login', [
        AuthController::class,
        'login'
    ])->name('login.process');


    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    Route::get('/register', [
        AuthController::class,
        'showRegister'
    ])->name('register');

    Route::post('/register', [
        AuthController::class,
        'register'
    ])->name('register.process');


    /*
    |--------------------------------------------------------------------------
    | GOOGLE LOGIN
    |--------------------------------------------------------------------------
    */

    Route::get('/auth/google', [
        AuthController::class,
        'redirectGoogle'
    ])->name('google.login');

    Route::get('/auth/google/callback', [
        AuthController::class,
        'googleCallback'
    ])->name('google.callback');


    /*
    |--------------------------------------------------------------------------
    | FORGOT PASSWORD
    |--------------------------------------------------------------------------
    */

    Route::get('/forgot-password', [
        AuthController::class,
        'showForgotPassword'
    ])->name('password.request');

    Route::post('/forgot-password', [
        AuthController::class,
        'sendResetCode'
    ])->name('password.send');


    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    Route::get('/reset-password', [
        AuthController::class,
        'showResetPassword'
    ])->name('password.reset.form');

    Route::post('/reset-password', [
        AuthController::class,
        'resetPassword'
    ])->name('password.reset');
});


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
| Hanya bisa diakses oleh user yang sudah login.
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/', [
        DashboardController::class,
        'index'
    ])->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | PENDAPATAN
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'incomes',
        IncomeController::class
    )->except(['show']);


    /*
    |--------------------------------------------------------------------------
    | PENGELUARAN
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'expenses',
        ExpenseController::class
    )->except(['show']);


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [
        AuthController::class,
        'logout'
    ])->name('logout');
});
