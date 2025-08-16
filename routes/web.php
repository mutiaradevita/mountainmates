<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Pengelola\TransaksiController as PengelolaTransaksiController;
use App\Http\Controllers\CallbackController;
use App\Http\Middleware\PreventBackHistory;

Route::middleware([
    'web',
    PreventBackHistory::class,
])->group(function () {

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ======================== GUEST ========================
Route::get('/', [HomeController::class, 'landing'])->middleware('guest')->name('landing');

Route::get('/home', function () {
    $user = Auth::user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'pengelola' => redirect()->route('pengelola.dashboard'),
        'peserta' => redirect()->route('peserta.jelajah'),
        default => abort(403),
    };
})->middleware('auth')->name('home');

// ======================== TRANSAKSI ========================
Route::post('/transaksi', [TransaksiController::class, 'store'])->middleware('auth')->name('transaksi.store');
Route::get('/invoice/{id}', [InvoiceController::class, 'generate'])->name('invoice.generate');

// ======================== PESERTA ========================
Route::prefix('peserta')->middleware(['auth', 'role:peserta'])->name('peserta.')->group(function () {
    Route::get('/jelajah', [TripPublicController::class, 'index'])->name('jelajah');
    Route::get('/jelajah/{id}', [TripPublicController::class, 'show'])->name('jelajah.detail');
    Route::get('/trip/{id}/pesan', [TransaksiController::class, 'form'])->name('peserta.form'); 
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('/transaksi/{id}/bayar-pelunasan', [TransaksiController::class, 'bayarPelunasan'])->name('transaksi.bayar-pelunasan');
    Route::post('/transaksi/{id}/batalkan', [TransaksiController::class, 'batalkan'])->name('transaksi.batalkan');
    Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan');
    Route::get('/ulasan/{trip}/buat', [UlasanController::class, 'create'])->name('ulasan.create');
    Route::post('/ulasan/{trip}', [UlasanController::class, 'store'])->name('ulasan.store');
    Route::get('/riwayat', [TransaksiController::class, 'index'])->name('peserta.transaksi.index');
    Route::get('/riwayat/{id}', [TransaksiController::class, 'show'])->name('peserta.transaksi.show');
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
    Route::get('/aktivitas', [DashboardController::class, 'aktivitas'])->name('aktivitas');
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
    Route::resource('trips', TripController::class);
    Route::get('/trip-history', [TripController::class, 'history'])->name('trips.history');
    Route::get('/trip-detail/{id}', [TripController::class, 'show'])->name('trips.show');
    Route::get('/trips/{trip}/peserta', [TripController::class, 'peserta'])->name('trips.peserta');
    Route::get('/invoice/{id}/cetak', [PengelolaTransaksiController::class, 'cetakInvoice'])->name('transaksi.invoice');
    Route::get('/transaksi/export/pdf', [PengelolaTransaksiController::class, 'exportPdf'])->name('transaksi.laporan');
    Route::get('/transaksi/export/excel', [PengelolaTransaksiController::class, 'exportExcel'])->name('transaksi.export.excel');
    Route::resource('dokumentasi', DokumentasiController::class);
});

// ======================== MIDTRANS WEBHOOK ========================
Route::post('/webhook/midtrans', [CallbackController::class, 'handle']);
});

require __DIR__.'/auth.php';