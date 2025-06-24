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

        return view('pengelola.dashboard', [
            'ulasanDiterima' => $ulasanDiterima,
            'pesertaAktif' => Transaksi::where('status', 'confirmed')
                ->whereHas('trip', fn($q) => $q->where('created_by', $userId))->count(),
            'belumVerifikasi' => Transaksi::where('status', 'pending')
                ->whereHas('trip', fn($q) => $q->where('created_by', $userId))->count(),
            'transaksiTripSaya' => $transaksiTripSaya,
        ]);
    }
}
