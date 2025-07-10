<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaksi;

class InvoiceController extends Controller
{
    public function generate($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $pdf = Pdf::loadView('transaksi.invoice', compact('transaksi'));
        return $pdf->download('invoice-'.$transaksi->id.'.pdf');
    }
}
