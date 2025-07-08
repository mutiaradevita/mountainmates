<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Transaksi;

class DataController extends Controller
{
    public function tripIndex()
    {
        $trips = Trip::with('user')->latest()->get();

        return view('admin.trip.index', compact('trips'));
    }

    public function tripShow(Trip $trip)
    {
        return view('admin.trip.show', compact('trip'));
    }

    public function transaksiIndex()
    {
        $transaksi = Transaksi::with(['trip.user'])->latest()->get();

        foreach ($transaksi as $t) {
            $t->pengelola_nama = $t->trip->user->company_name ?? '-';
        }

        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function tripDestroy(Trip $trip)
    {
        $trip->delete();

        return redirect()->route('admin.trip.index')->with('success', 'Trip berhasil dihapus.');
    }

    public function transaksiDestroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
