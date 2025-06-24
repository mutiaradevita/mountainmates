<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $transaksis = Transaksi::with(['trip', 'peserta'])
            ->whereHas('trip', fn($q) => $q->where('created_by', $userId))
            ->latest()
            ->get();

        return view('pengelola.transaksi.index', compact('transaksis'));
    }

    public function konfirmasi($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'confirmed';
        $transaksi->save();

        return redirect()->back()->with('success', 'Transaksi berhasil dikonfirmasi.');
    }
}
