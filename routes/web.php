<?php

use App\Http\Controllers\Questions\LeetcodeController;
use App\Http\Controllers\register\LoginController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('landing');
})->name('landing');

Route::middleware('guest')->group(function() {
    Route::get('/login', function() {
        return view('register.login');
    })->name('login.show');
    Route::post('/login', [LoginController::class, 'store_login'])->name('login');
    Route::get('/register', function() {
        return view('register.signUp');
    })->name('login.signup');
    Route::post('/register', [LoginController::class, 'store_register']);
    // start git login
    Route::get('/auth/git/redirect', [LoginController::class, 'gitRedirect'])->name('login.git');
    Route::get('/auth/git/callback', [LoginController::class, 'gitCallback']);
    // end git login

    // start google login
    Route::get('/auth/google/redirect', [LoginController::class, 'googleRedirect'])->name('login.google');
    Route::get('/auth/google/callback', [LoginController::class, 'googleCallback']);
    // end google login
});

Route::middleware('auth:web')->group(function() {
    Route::get('/home', function() {
        return view('userAccess.dashboard');
    })->name('user.home');
    Route::get('/techbank', [LeetcodeController::class, 'index'])->name('techbank.display');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('auth:web')->group(function() {
    Route::prefix('/coding')->group(function() {
        Route::get('/store', [LeetcodeController::class, 'store'])->name('code.store');
    });
});

