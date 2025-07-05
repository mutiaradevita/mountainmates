<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripPublicController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pengelola\TransaksiController as PengelolaTransaksiController;
use App\Http\Controllers\CallbackController;


// ======================== GUEST ========================
Route::get('/', [HomeController::class, 'landing'])->middleware('guest')->name('landing');

// Redirect setelah login
Route::get('/home', fn () => redirect()->route('jelajah'))->middleware('auth')->name('home');

// ======================== PUBLIK ========================
Route::get('/jelajah', [TripPublicController::class, 'index'])->name('jelajah');
// Route::get('/jelajah-trip', [TripPublicController::class, 'index'])->name('pendaki.index');
Route::get('/jelajah/{id}', [TripPublicController::class, 'show'])->name('jelajah.detail');
// Route::get('/trip/{id}/form', [TripPublicController::class, 'form'])->name('pemesanan.form');
Route::get('/trip/{id}/pesan', [TransaksiController::class, 'form'])->name('peserta.form');

// ======================== TRANSAKSI ========================
Route::post('/transaksi', [TransaksiController::class, 'store'])->middleware('auth')->name('transaksi.store');

// ======================== PESERTA ========================
Route::prefix('peserta')->middleware(['auth', 'role:peserta'])->name('peserta.')->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('/transaksi/{id}/bayar-pelunasan', [TransaksiController::class, 'bayarPelunasan'])->name('transaksi.bayar-pelunasan');
    Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan');
    Route::get('/ulasan/{trip}/buat', [UlasanController::class, 'create'])->name('ulasan.create');
    Route::post('/ulasan/{trip}', [UlasanController::class, 'store'])->name('ulasan.store');
    Route::get('/riwayat', [TransaksiController::class, 'index'])->name('peserta.transaksi.index');
    Route::get('/riwayat/{id}', [TransaksiController::class, 'show'])->name('peserta.transaksi.show');
    Route::get('/transaksi/{id}/bayar', [TransaksiController::class, 'bayar'])->name('transaksi.bayar');

});

// ======================== PROFILE ========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========================== ADMIN ==========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () { 
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::resource('berita', BeritaController::class)->parameters(['berita' => 'berita']);
    Route::resource('user', UserController::class);
    Route::get('trip', [DataController::class, 'tripIndex'])->name('trip.index');
    Route::get('trip/{trip}', [DataController::class, 'tripShow'])->name('trip.show');
    Route::delete('trip/{trip}', [DataController::class, 'tripDestroy'])->name('trip.destroy');
    Route::get('transaksi', [DataController::class, 'transaksiIndex'])->name('transaksi.index');
    Route::get('transaksi/{transaksi}', [DataController::class, 'transaksiShow'])->name('transaksi.show');
    Route::delete('transaksi/{transaksi}', [DataController::class, 'transaksiDestroy'])->name('transaksi.destroy');
});

// ======================== PENGELOLA ========================
Route::middleware(['auth', 'role:pengelola'])->prefix('pengelola')->name('pengelola.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'indexPengelola'])->name('dashboard');
    Route::get('/transaksi', [PengelolaTransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/{id}/konfirmasi', [PengelolaTransaksiController::class, 'konfirmasi'])->name('transaksi.konfirmasi');
    Route::resource('trips', TripController::class);
    Route::get('/trip-history', [TripController::class, 'history'])->name('trips.history');
    Route::get('/trip-detail/{id}', [TripController::class, 'show'])->name('trips.show');
    Route::get('/trips/{trip}/peserta', [TripController::class, 'peserta'])->name('trips.peserta');
});

// ======================== MIDTRANS WEBHOOK ========================
Route::post('/webhook/midtrans', [CallbackController::class, 'handle']);

require __DIR__.'/auth.php';
