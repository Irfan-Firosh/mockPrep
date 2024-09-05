<?php

use App\Http\Controllers\internship\TechController;
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
    Route::post('/techbank', [LeetcodeController::class, 'search'])->name('techbank.search');
    Route::prefix('analytics')->group(function() {
        Route::get('/', [LeetcodeController::class, 'analytics'])->name('analytics');
        Route::get('/setname', function() {
            return view('analytics.nameform');
        })->name('analytics.setname');
        Route::post('/setname', [LeetcodeController::class, 'changeName'])->name('analytics.setname');
    });
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});


// These are the ones that need to be automated
Route::middleware('auth:web')->group(function() {
    Route::prefix('/coding')->group(function() {
        Route::get('/store', [LeetcodeController::class, 'store'])->name('code.store');
    });
    Route::prefix('/internships')->group(function() {
        Route::get('/', function() {
            return view('internship.form');
        })->name('internships.display');
        Route::post('/', [TechController::class, 'index'])->name('internships.retrieve');
        Route::get('/fetch/{page}/{location}/{title}/{code}', [TechController::class, 'store'])->name('internships.fetch');
    });
});

