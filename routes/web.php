<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AccountController;

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

Route::get('/', [HomeController::class, 'user'])->name('home');
Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
Route::get('/register', [HomeController::class, 'register'])->name('register');

Route::post('/register/create', [AccountController::class, 'register'])->name('register');
