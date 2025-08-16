<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Models\Trip;
use Illuminate\Http\Request;

class DokumentasiController extends Controller
{
    public function index()
    {
        // Ambil semua dokumentasi trip beserta relasi trip-nya
        $dokumentasi = Dokumentasi::with('trip')->latest()->get();

        return view('pengelola.dokumentasi.index', compact('dokumentasi'));
    }

    public function create()
    {
        $trips = Trip::all(); 
        
        return view('pengelola.dokumentasi.create', compact('trips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_trip' => 'required|exists:trips,id',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string'
        ]);

        $path = $request->file('foto')->store('dokumentasi', 'public');

        Dokumentasi::create([
            'id_trip' => $request->id_trip,
            'foto' => $path,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('pengelola.dokumentasi.index')
                         ->with('success', 'Dokumentasi berhasil ditambahkan!');
    }
    public function destroy(Dokumentasi $dokumentasi)
    {
        
        $dokumentasi->delete();

        return redirect()->route('pengelola.dokumentasi.index')->with('success', 'Dokumentasi berhasil dihapus.');
    }
}
