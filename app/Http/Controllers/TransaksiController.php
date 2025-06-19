<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Trip;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::with('trip')->where('id_user', auth()->id())->get();
            return view('riwayat', compact('transaksis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'jumlah_peserta' => 'required|integer|min:1',
            'paket' => 'required|string',
            'trip_id' => 'required|exists:trips,id', 
        ]);

        $trip = Trip::findOrFail($request->trip_id);
        $total = $trip->harga * $request->jumlah_peserta;

        $transaksi = new Transaksi();
        $transaksi->id_user = auth()->id(); 
        $transaksi->id_trip = $trip->id; 
        $transaksi->jumlah = $request->jumlah_peserta;
        $transaksi->total = $total; 
        $transaksi->status = 'menunggu';
        $transaksi->save();

        return redirect()->route('peserta.transaksi.index')->with('success', 'Transaksi berhasil dilakukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::with('trip')->where('id_user', auth()->id())->findOrFail($id);

        return view('transaksi.detail-transaksi', compact('transaksi'));
    }
}
