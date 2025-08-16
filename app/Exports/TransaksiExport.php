<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;

class TransaksiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $userId = Auth::id();
        
        return Transaksi::with('trip', 'user')
            ->whereHas('trip', fn($q) => $q->where('created_by', $userId))
            ->get()
            ->map(function ($item) {
                return [
                    'Nama Pemesan'     => $item->nama,
                    'Email'            => $item->email,
                    'Trip'             => $item->trip->nama_trip ?? '-',
                    'Jumlah Peserta'   => $item->jumlah_peserta,
                    'Total Bayar'      => $item->total,
                    'Status Pembayaran'=> ucfirst($item->status_pembayaran),
                    'Status Trip'      => ucfirst($item->status),
                    'Tanggal'          => $item->created_at->format('d-m-Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Pemesan',
            'Email',
            'Trip',
            'Jumlah Peserta',
            'Total Bayar',
            'Status Pembayaran',
            'Status Trip',
            'Tanggal',
        ];
    }
}

