<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripPublicController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\ParticipantController;

// Redirect root ke halaman home
Route::get('/', fn () => redirect()->route('home'))->name('home');
Route::get('/jelajah', fn () => redirect()->route('jelajah'))->name('jelajah');


// Halaman utama / landing page
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Halaman jelajah (semua user bisa lihat)
Route::get('/jelajah', [TripPublicController::class, 'index'])->name('jelajah');
Route::get('/jelajah-trip', [TripPublicController::class, 'index'])->name('pendaki.index');
Route::get('/jelajah/{id}', [TripPublicController::class, 'show'])->name('jelajah.detail');

// Halaman Transaksi (sementara tanpa auth, nanti bisa dibatasi role:pendaki)
Route::get('/riwayat', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/transaksi', [TransaksiController::class, 'store'])->middleware('auth')->name('transaksi.store');



// Auth & Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========================== ADMIN ==========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');
    // Tambahkan route admin lainnya di sini
});

// ======================== PENGELOLA ========================
Route::middleware(['auth', 'role:pengelola'])->prefix('pengelola')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('pengelola.dashboard');
    Route::resource('trips', TripController::class);
    Route::get('/trip-history', [TripController::class, 'history'])->name('pengelola.trips.history');
    Route::get('/trip-detail/{id}', [TripController::class, 'show'])->name('trips.show');
});


require __DIR__.'/auth.php';
