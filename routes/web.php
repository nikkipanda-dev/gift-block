<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;

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
Route::get('/shop', [DashboardController::class, 'shop'])->name('shop.index');

// Auth
Route::post('/register/store', [AccountController::class, 'store'])->name('register.store');
Route::post('/admin/auth', [AccountController::class, 'authenticate'])->name('admin.auth');
Route::post('/cust/auth', [AccountController::class, 'authenticate'])->name('customer.auth');

// Shop views
Route::get('/shop/dashboard', [DashboardController::class, 'customer'])->name('customer.index');
Route::get('/shop/products', [DashboardController::class, 'customerProd'])->name('customer.products.index');
Route::get('/shop/settings', [DashboardController::class, 'settings'])->name('customer.settings.index');
Route::get('/shop/cart', [DashboardController::class, 'cart'])->name('customer.cart.index');

// Admin views
Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.index');
Route::get('/admin/orders', [DashboardController::class, 'order'])->name('admin.orders.index');
Route::get('/admin/products', [DashboardController::class, 'adminProd'])->name('admin.products.index');

// Product
Route::get('/admin/products/all', [ProductController::class, 'getProd'])->name('admin.products.all');
Route::get('/shop/products/all', [ProductController::class, 'getProd'])->name('customer.products.all');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::post('/products/update', [ProductController::class, 'update'])->name('products.update');
Route::post('/products/destroy', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/cart/show', [ShopController::class, 'showCart'])->name('cart.show');
Route::post('/products/cart/store', [ShopController::class, 'storeCart'])->name('cart.store');

// Shipping address
Route::get('/address/all', [ShopController::class, 'getAdr'])->name('address.all');
Route::post('/address/store', [ShopController::class, 'storeAdr'])->name('address.store');
Route::post('/address/update', [ShopController::class, 'updateAdr'])->name('address.update');
Route::post('/address/destroy', [ShopController::class, 'destroyAdr'])->name('address.destroy');
