<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'indexAdmin'])->name('dashboard.admin');
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
