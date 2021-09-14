<?php

use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'login'])->middleware('AlreadyLoggedIn')->name('auth.login');
Route::post('/login', [LoginController::class, 'check_login'])->name('check.login');
Route::get('/register', [LoginController::class, 'register'])->middleware('AlreadyLoggedIn')->name('auth.register');
Route::post('/register', [LoginController::class, 'check_register'])->name('check.register');
Route::get('/profile', [LoginController::class, 'auth_profile'])->middleware('NotLoggedIn')->name('auth.profile');
Route::get('/logout', [LoginController::class, 'auth_logout'])->name('auth.logout');
