<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Trip;
use App\Models\Ulasan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalTrip = Trip::count();
        $totalUser = User::count();
        $orderPending = Transaksi::where('status_pembayaran', 'dp')->count();
        $orderSelesai = Transaksi::where('status_pembayaran', 'lunas')->count();
        $jumlahPeserta = User::where('role', 'peserta')->count();
        $jumlahPengelola = User::where('role', 'pengelola')->count();
        

        // Trip Terpopuler (top 5 berdasarkan jumlah peserta)
        $topTrips = Trip::withCount('transaksi')
            ->orderByDesc('transaksi_count')
            ->take(5)
            ->get()
            ->map(function ($trip) {
                $trip->jumlah_peserta = $trip->transaksi_count;
                return $trip;
            });

        // Aktivitas terbaru dari user, trip, dan transaksi (tanpa tabel tambahan)
        $recentActivities = collect()
            ->merge(User::latest()->take(5)->get()->map(function ($user) {
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

        return view('admin.dashboard', compact('orderPending','orderSelesai', 'totalTrip', 'totalUser', 'topTrips', 'recentActivities', 'jumlahPeserta', 'jumlahPengelola'));
    }

    public function aktivitas()
    {
        $aktivitas = collect()
            ->merge(User::latest()->get()->map(function ($user) {
                return [
                    'waktu' => $user->created_at,
                    'pesan' => $user->role === 'pengelola' 
                        ? "Pengelola baru mendaftar: {$user->name}" 
                        : "Peserta baru mendaftar: {$user->name}"
                ];
            }))
            ->merge(Trip::latest()->get()->map(function ($trip) {
                return [
                    'waktu' => $trip->created_at,
                    'pesan' => "Trip baru ditambahkan: {$trip->nama_trip}"
                ];
            }))
            ->merge(Transaksi::latest()->get()->map(function ($trx) {
                return [
                    'waktu' => $trx->created_at,
                    'pesan' => "Pesanan baru dibuat oleh: {$trx->nama}"
                ];
            }))
            ->sortByDesc('waktu');

        return view('admin.aktivitas', compact('aktivitas'));
    }
    
     public function indexPengelola()
    {
        $userId = Auth::id();

        $totalTripSaya = Trip::where('created_by', $userId)->count();

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
                    'name' => $trip->nama_trip,
                    'start' => Carbon::parse($trip->tanggal_mulai),
                    'end' => Carbon::parse($trip->tanggal_selesai)->endOfDay(),
                ];
            });

        $today = Carbon::today();

        $tripBerlangsung = Trip::whereHas('transaksi', function ($q) {
                $q->whereIn('status', ['menunggu', 'dp', 'confirmed']);
            })
            ->where('created_by', $userId)
            ->whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->count();

        $tripAkanDatang = Trip::whereHas('transaksi', function ($q) {
                $q->whereIn('status', ['menunggu', 'dp', 'confirmed']);
            })
            ->where('created_by', $userId)
            ->whereDate('tanggal_mulai', '>', $today)
            ->count();

        $tripSelesai = Trip::whereHas('transaksi', function ($q) {
                $q->whereIn('status', ['selesai']);
            })
            ->where('created_by', $userId)
            ->whereDate('tanggal_selesai', '<', $today)
            ->count();

        $pesertaBatal = Transaksi::where('status', 'batal')
        ->whereHas('trip', function ($query) {
            $query->where('id_user');
        })
        ->count();

        $totalPeserta = Transaksi::whereHas('trip', fn($q) => $q->where('created_by', $userId))
            ->sum('jumlah_peserta');

        $pesertaBelumLunas = Transaksi::whereHas('trip', fn($q) => $q->where('created_by', $userId))
            ->where('status_pembayaran', 'dp')
            ->count();

        $transaksiLunas = Transaksi::whereHas('trip', fn($q) => $q->where('created_by', $userId))
            ->where('status_pembayaran', 'lunas')
            ->count();

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


        return view('pengelola.dashboard', [
            'ulasanDiterima' => $ulasanDiterima,
            'transaksiTripSaya' => $transaksiTripSaya,
            'tripEvents' => $tripEvents,
            'tripBerlangsung' => $tripBerlangsung,
            'tripAkanDatang' => $tripAkanDatang,
            'tripSelesai' => $tripSelesai,
            'pesertaBatal' => $pesertaBatal,
            'totalPeserta' => $totalPeserta,
            'pesertaBelumLunas' => $pesertaBelumLunas,
            'transaksiLunas' => $transaksiLunas,
            'recentNotifikasi' => $recentNotifikasi,
            'totalTripSaya' => $totalTripSaya,
        ]);
    }
}