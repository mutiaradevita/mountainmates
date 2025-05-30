<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'indexAdmin'])->name('dashboard.admin');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

});

Route::prefix('eo')->group(function () {
    Route::get('/', [DashboardController::class, 'indexEo'])->name('dashboard.eo');
});

Route::prefix('user')->group(function () {
    Route::get('/', [DashboardController::class, 'indexUser'])->name('user.index');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/jelajah', function () {return view('jelajah');
});

