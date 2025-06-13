<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {return redirect()->route('home'); })->name('home');

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/jelajah', function () {return view('jelajah'); })->name('jelajah');

Route::get('/trip-detail', [DetailController::class, 'show'])->name('trip.detail');

//  Route::middleware('auth:user')->group(function () {
//         Route::resource('/transaksi', TransaksiController::class)->only([
//             'store',]);
//     });

Route::get('/transaksi', [TransaksiController::class, 'index']);

// // Halaman untuk admin
// Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// // Halaman untuk pengelola
// Route::get('/pengelola/dashboard', [PengelolaController::class, 'index'])->name('pengelola.dashboard');
require __DIR__.'/auth.php';
