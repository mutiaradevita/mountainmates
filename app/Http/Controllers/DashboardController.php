<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Trip;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalUser = User::count();
        $totalTrip = Trip::count();
        $orderPending = Transaksi::where('status', 'menunggu')->count();
        $orderSelesai = Transaksi::where('status', 'selesai')->count();
        

        return view('admin.dashboard', [
            'orderPending' => Transaksi::where('status', 'menunggu')->count(),
            'orderSelesai' => Transaksi::where('status', 'confirmed')->count(),
            'totalTrip' => Trip::count(),
            'totalUser' => User::count(),
        ]);
    }
    
    public function indexPengelola()
    {
        $userId = Auth::id();

        $ulasanDiterima = Ulasan::whereHas('trip', function ($query) use ($userId) {
            $query->where('created_by', $userId);
        })->latest()->get();

          $transaksiTripSaya = Transaksi::with(['trip', 'peserta'])
        ->whereHas('trip', fn($q) => $q->where('created_by', $userId))
        ->latest()
        ->get();

        $tripEvents = Trip::where('created_by', $userId)
    ->get(['nama_trip', 'tanggal_mulai', 'tanggal_selesai'])
    ->map(function ($trip) {
        return [
            'name' => $trip->nama_trip, // sesuaikan ke JS
            'start' => \Carbon\Carbon::parse($trip->tanggal_mulai)->toIso8601String(),
            'end' => \Carbon\Carbon::parse($trip->tanggal_selesai)->endOfDay()->toIso8601String(),
        ];
    });


        return view('pengelola.dashboard', [
            'ulasanDiterima' => $ulasanDiterima,
            'pesertaAktif' => Transaksi::where('status_pembayaran', 'confirmed')
                ->whereHas('trip', fn($q) => $q->where('created_by', $userId))->count(),
            'belumVerifikasi' => Transaksi::where('status_pembayaran', 'pending')
                ->whereHas('trip', fn($q) => $q->where('created_by', $userId))->count(),
            'transaksiTripSaya' => $transaksiTripSaya,
            'tripEvents' => $tripEvents,
        ]);
    }
}
