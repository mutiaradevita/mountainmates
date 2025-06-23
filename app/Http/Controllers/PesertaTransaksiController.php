<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesertaTransaksi;

class PesertaTransaksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksis,id',
            'id_trip' => 'required|exists:trips,id',
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        PesertaTransaksi::create($request->all());

        return redirect()->back()->with('success', 'Peserta berhasil ditambahkan.');
    }
}

