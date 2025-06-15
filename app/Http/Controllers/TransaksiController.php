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
        $transaksis = Transaksi::with('tiket')->where('id_user', auth()->id())->get();
            return view('riwayat', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'trip_id' => 'required|exists:trips,id', // Asumsi trip_id yang dipilih ada
        ]);

        // Ambil data trip berdasarkan trip_id
        $trip = Trip::findOrFail($request->trip_id);

        // Hitung total harga berdasarkan jumlah peserta
        $total = $trip->harga * $request->jumlah_peserta;

        // Menyimpan transaksi ke tabel 'transaksis'
        $transaksi = new Transaksi();
        $transaksi->id_user = auth()->id(); // ID pengguna yang login
        $transaksi->id_tiket = $trip->id; // ID trip
        $transaksi->jumlah = $request->jumlah_peserta; // Jumlah peserta
        $transaksi->total = $total; // Total harga
        $transaksi->save();

        return redirect()->route('trips.index')->with('success', 'Transaksi berhasil dilakukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
