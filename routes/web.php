<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\DashboardController;
use Inertia\Inertia;



Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/products', [DashboardController::class, 'productList'])->name('dashboard-product');
    Route::get('/dashboard/products/add', [ProductController::class, 'create'])->name('show-product-add');
    Route::post('/dashboard/products/add', [ProductController::class, 'store'])->name('product-add');
    Route::get('/dashboard/products/{product}/delete', [ProductController::class, 'destroy'])->name('product-delete');
    Route::put('/dashboard/products/{product}/edit', [ProductController::class, 'edit'])->name('product-edit');


    Route::post('/order/{order}', [OrderController::class, 'update'])->name('update-order');

    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/product/{product}', [ProductController::class, 'show']);
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'editProfile'])->name('edit-profile');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/order', [OrderController::class, 'create'])->name('create-order');
    Route::get('/order', [OrderController::class, 'show'])->name('show-order');
    Route::delete('/order', [OrderController::class, 'delete'])->name('cancel-order');
    Route::get('/create-pdf-file/{order}', [PDFController::class, 'index']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::get('/login-admin', [LoginController::class, 'showLoginAdmin'])->name('show-login-admin');
    Route::post('/login-admin', [LoginController::class, 'loginAdmin'])->name('login-admin');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});




