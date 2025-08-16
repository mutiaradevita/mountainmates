<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;

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

    public function cetakInvoice($id)
    {
        $transaksi = Transaksi::with('trip')->findOrFail($id);

        $pdf = PDF::loadView('pengelola.transaksi.invoice', compact('transaksi'));
        return $pdf->download('invoice-trip-' . $transaksi->id . '.pdf');
    }
    public function exportPdf()
    {
        $userId = Auth::id();

        $transaksi = Transaksi::with('trip')->whereHas('trip', fn($q) => $q->where('created_by', $userId))
        ->get();
        $pdf = Pdf::loadView('pengelola.transaksi.laporan', compact('transaksi'));
        return $pdf->download('laporan_transaksi.pdf');
    }

    public function exportExcel()
    {
        $userId = Auth::id();
        
        $transaksi = Transaksi::with('trip')->whereHas('trip', fn($q) => $q->where('created_by', $userId))
        ->get();

        return Excel::download(new TransaksiExport, 'laporan_transaksi.xlsx');
    }
}
