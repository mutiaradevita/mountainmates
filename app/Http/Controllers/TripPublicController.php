<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;


class TripPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Trip::where('status', 'aktif');

        if ($request->tanggal) {
            $query->whereDate('tanggal_mulai', $request->tanggal);
        }

        if ($request->cari) {
            $query->where(function($q) use ($request) {
                $q->where('nama_trip', 'like', '%' . $request->cari . '%')
                ->orWhere('lokasi', 'like', '%' . $request->cari . '%');
            });
        }

        $trips = $query->latest()->take(10)->get();
        $lokasiList = Trip::select('lokasi')->distinct()->pluck('lokasi');

        return view('jelajah', compact('trips', 'lokasiList'));
    }

    public function show($id)
    {
        $trip = Trip::where('status', 'aktif')->findOrFail($id);
        return view('peserta.detail', compact('trip'));
    }
    public function form($id)
    {
        if (!session()->has('_old_input')) {
        session()->forget('_old_input');
    }
        $trip = Trip::findOrFail($id);
        return view('peserta.form', compact('trip'));
    }
}

