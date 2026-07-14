<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer;
use Illuminate\Support\Facades\Route;

// -----------------------------------------------------------------------
// Public Routes
// -----------------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/landing', function () {
    return view('landingpage');
})->name('landing');

// -----------------------------------------------------------------------
// Guest-only Auth Routes
// -----------------------------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::get('/register/pending', [RegisterController::class, 'pending'])->name('register.pending');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// -----------------------------------------------------------------------
// Customer Routes (auth + role:pelanggan)
// -----------------------------------------------------------------------
Route::middleware(['auth', 'role:pelanggan'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [Customer\DashboardController::class, 'index'])->name('dashboard');

    // Packages
    Route::get('/packages', [Customer\PackageController::class, 'index'])->name('packages.index');

    // Orders
    Route::get('/orders', [Customer\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{package}/create', [Customer\OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [Customer\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [Customer\OrderController::class, 'show'])->name('orders.show');

    // Payments
    Route::get('/orders/{order}/payment', [Customer\PaymentController::class, 'create'])->name('payments.create');
    Route::post('/orders/{order}/payment', [Customer\PaymentController::class, 'store'])->name('payments.store');

    // Announcements
    Route::get('/announcements', [Customer\AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/{announcement}', [Customer\AnnouncementController::class, 'show'])->name('announcements.show');
});

// -----------------------------------------------------------------------
// Admin Routes (auth + role:admin)
// -----------------------------------------------------------------------
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // User Verification
    Route::get('/users', [Admin\UserVerificationController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/verify', [Admin\UserVerificationController::class, 'verify'])->name('users.verify');

    // Order Management
    Route::get('/orders', [Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [Admin\OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/verify', [Admin\OrderController::class, 'verify'])->name('orders.verify');

    // Payment Verification
    Route::get('/payments', [Admin\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [Admin\PaymentController::class, 'show'])->name('payments.show');
    Route::patch('/payments/{payment}/verify', [Admin\PaymentController::class, 'verify'])->name('payments.verify');

    // Announcements CRUD
    Route::resource('announcements', Admin\AnnouncementController::class);
});
