<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Ulasan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); 
        $ulasans = Ulasan::where('id_user', $userId)->with('trip')->get();

        return view('peserta.ulasan.index',compact('ulasans'));
    }

    public function create($id_transaksi)
    {
    $transaksi = Transaksi::where('id_user', Auth::id())->with('trip')->findOrFail($id_transaksi);

    if ($transaksi->status !== 'selesai') {
        return redirect()->route('peserta.transaksi.index')->with('error', 'Kamu hanya bisa memberikan ulasan setelah trip selesai.');
    }

    if ($transaksi->ulasan) {
        return redirect()->route('peserta.transaksi.index')->with('error', 'Ulasan sudah dibuat.');
    }

        return view('peserta.ulasan.create', compact('transaksi'));
    }

    public function store(Request $request, $id_transaksi)
    {
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'komentar' => 'required|string|max:1000',
    ]);

    $transaksi = Transaksi::with('trip')->findOrFail($id_transaksi);

    Ulasan::create([
        'id_user' => Auth::id(),
        'id_trip' => $transaksi->id_trip,
        'id_transaksi' => $transaksi->id,
        'nama_trip' => $transaksi->trip->nama_trip ?? 'Trip Dihapus',
        'komentar' => $request->komentar,
        'rating' => $request->rating,
    ]);

        return redirect()->route('peserta.transaksi.index')->with('success', 'Ulasan berhasil dikirim!');
    }
}