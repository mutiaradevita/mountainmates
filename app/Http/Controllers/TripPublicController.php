<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

class TripPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Trip::where('status', 'aktif');

        // Filter tanggal
        if ($request->tanggal) {
            $query->whereDate('tanggal_mulai', $request->tanggal);
        }

        // Filter nama trip atau lokasi
        if ($request->cari) {
            $query->where(function($q) use ($request) {
                $q->where('nama_trip', 'like', '%' . $request->cari . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->cari . '%');
            });
        }

        // === Sorting ===
        if ($request->urutkan === 'rating') {
            $trips = $query->with(['ulasans', 'pengelola'])->get();

            // Hitung average rating dan jumlah ulasan trip
            $trips = $trips->map(function ($trip) {
                $trip->average_rating = $trip->ulasans->avg('rating') ?? 0;
                $trip->ulasan_count = $trip->ulasans->count();

                // Hitung rata-rata semua trip milik pengelola
                if ($trip->pengelola) {
                    $allTripsByPengelola = Trip::where('created_by', $trip->created_by)
                        ->with('ulasans')
                        ->get();

                    $allRatings = $allTripsByPengelola->pluck('ulasans')->flatten();
                    $trip->pengelola_rating = $allRatings->avg('rating') ?? 0;
                    $trip->pengelola_ulasan_count = $allRatings->count();
                } else {
                    $trip->pengelola_rating = 0;
                    $trip->pengelola_ulasan_count = 0;
                }

                return $trip;
            })->sortByDesc('pengelola_rating')->values(); // Urut dari rating pengelola tertinggi
        } else {
            // Urutan default: harga atau terbaru
            if ($request->urutkan === 'harga') {
                $query->orderBy('harga', 'asc');
            } else {
                $query->latest();
            }

            $trips = $query->with(['pengelola', 'ulasans'])->get();

            $trips = $trips->map(function ($trip) {
                $trip->average_rating = $trip->ulasans->avg('rating') ?? 0;
                $trip->ulasan_count = $trip->ulasans->count();

                if ($trip->pengelola) {
                    $allTripsByPengelola = Trip::where('created_by', $trip->created_by)
                        ->with('ulasans')
                        ->get();

                    $allRatings = $allTripsByPengelola->pluck('ulasans')->flatten();
                    $trip->pengelola_rating = $allRatings->avg('rating') ?? 0;
                    $trip->pengelola_ulasan_count = $allRatings->count();
                } else {
                    $trip->pengelola_rating = 0;
                    $trip->pengelola_ulasan_count = 0;
                }

                return $trip;
            });
        }

        $lokasiList = Trip::select('lokasi')->distinct()->pluck('lokasi');

        return view('jelajah', compact('trips', 'lokasiList'));
    }

    public function show($id)
    {
        $trip = Trip::where('status', 'aktif')->findOrFail($id);
        $sisaKuota = $trip->kuota - $trip->transaksi()->where('status', '!=', 'batal')->sum('jumlah_peserta');
        $trips = Trip::with('dokumentasi')->findOrFail($id);
        
        return view('peserta.detail', compact('trip', 'sisaKuota'));
    }

    public function form($id)
    {
        if (!session()->has('_old_input')) {
            session()->forget('_old_input');
        }

        $trip = Trip::findOrFail($id);
        $sisaKuota = $trip->kuota - $trip->transaksi()->where('status', '!=', 'batal')->sum('jumlah_peserta');

        return view('peserta.form', compact('trip', 'sisaKuota'));
    }
}
