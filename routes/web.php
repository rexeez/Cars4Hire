<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    return view('landing');
});

Route::get('/home', [PageController::class, 'home']);
Route::get('/rent', [PageController::class, 'rent']);
Route::get('/login', [PageController::class, 'login']);
Route::get('/register', [PageController::class, 'register']);
Route::get('/car/{id}', [PageController::class, 'car']);


Route::post('/register', [UserController::class, 'register']);

Route::post('/hire', [PageController::class, 'hire']);

Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/rent', [CarController::class, 'store']);

Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('google/callback', [LoginController::class, 'handleGoogleCallback']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
