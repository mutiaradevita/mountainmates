<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('trip')->where('id_user', Auth::id())->get();
        return view('riwayat', compact('transaksis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'jumlah_peserta' => 'required|integer|min:1',
            'paket' => 'required|string',
            'id_trip' => 'required|exists:trips,id', 
            'bulan' => 'required|string',
            'jadwal' => 'required|string',
            'metode_pembayaran' => 'required|string',
        ]);

        $trip = Trip::findOrFail($request->id_trip);
        $total = $trip->harga * $request->jumlah_peserta;

            $transaksi = new Transaksi();
            $transaksi->id_user = Auth::id();
            $transaksi->id_trip = $request->id_trip;
            $transaksi->nama = $request->nama;
            $transaksi->nomor_telepon = $request->nomor_telepon;
            $transaksi->email = $request->email;
            $transaksi->jumlah_peserta = $request->jumlah_peserta;
            $transaksi->paket = $request->paket;
            $transaksi->bulan = $request->bulan;
            $transaksi->jadwal = $request->jadwal;
            $transaksi->catatan_khusus = $request->catatan_khusus;
            $transaksi->metode_pembayaran = $request->metode_pembayaran;
            $transaksi->total = $total;
            $transaksi->status = 'menunggu';

            $transaksi->save();

            // // Simpan peserta jika ada
            // if ($request->has('peserta')) {
            //     foreach ($request->peserta as $data) {
            //         $transaksi->pesertas()->create($data);
            //     }
            // }

        return redirect()->route('peserta.transaksi.index')->with('success', 'Transaksi berhasil dilakukan');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('trip')->where('id_user', Auth::id())->findOrFail($id);
        return view('transaksi.detail-transaksi', compact('transaksi'));
    }
}
