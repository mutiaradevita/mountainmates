<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Ulasan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
public function boot(): void
{
    View::composer('*', function ($view) {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                // recentActivities untuk admin
                $recentActivities = collect()
                    ->merge(\App\Models\User::latest()->take(5)->get()->map(function ($user) {
                        return [
                            'waktu' => $user->created_at,
                            'pesan' => $user->role === 'pengelola'
                                ? "Pengelola baru mendaftar: {$user->name}"
                                : "Peserta baru mendaftar: {$user->name}"
                        ];
                    }))
                    ->merge(Trip::latest()->take(5)->get()->map(function ($trip) {
                        return [
                            'waktu' => $trip->created_at,
                            'pesan' => "Trip baru ditambahkan: {$trip->nama_trip}"
                        ];
                    }))
                    ->merge(Transaksi::latest()->take(5)->get()->map(function ($trx) {
                        return [
                            'waktu' => $trx->created_at,
                            'pesan' => "Pesanan baru dibuat oleh: {$trx->nama}"
                        ];
                    }))
                    ->sortByDesc('waktu')
                    ->take(5);

                $view->with('recentActivities', $recentActivities);
            }

            if ($user->role === 'pengelola') {
                $ulasanDiterima = Ulasan::whereHas('trip', function ($query) use ($user) {
                    $query->where('created_by', $user->id);
                })->latest()->get();

                $transaksiTripSaya = Transaksi::with(['trip', 'peserta'])
                    ->whereHas('trip', fn($q) => $q->where('created_by', $user->id))
                    ->latest()
                    ->get();

                $recentNotifikasi = collect()
                    ->merge($ulasanDiterima->map(function ($u) {
                        return [
                            'waktu' => $u->created_at,
                            'pesan' => "Ulasan baru dari peserta: {$u->user->name}",
                        ];
                    }))
                    ->merge($transaksiTripSaya->map(function ($trx) {
                        return [
                            'waktu' => $trx->created_at,
                            'pesan' => "{$trx->nama} mendaftar trip {$trx->trip->nama_trip}",
                        ];
                    }))
                    ->sortByDesc('waktu')
                    ->take(5);

                $view->with('recentNotifikasi', $recentNotifikasi);
            }
        }
    });
}
}
