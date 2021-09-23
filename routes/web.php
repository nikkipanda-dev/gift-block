<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
Route::get('/register', [HomeController::class, 'register'])->name('register.index');

Route::post('/register/create', [AccountController::class, 'store'])->name('register.store');
Route::post('/admin/auth', [AccountController::class, 'authenticate'])->name('admin.auth');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.index');
