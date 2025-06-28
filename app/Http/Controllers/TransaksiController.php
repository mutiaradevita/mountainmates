<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\PesertaTransaksi;
use App\Models\Trip;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('trip')
        ->where('id_user', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

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
            $transaksi->catatan_khusus = $request->catatan_khusus;
            $transaksi->total = $total;
            $transaksi->status = 'menunggu';

            $transaksi->save();

            if ($request->has('peserta')) {
                foreach ($request->peserta as $peserta) {
                    if (!empty($peserta['nama'])) {
                        PesertaTransaksi::create([
                            'id_transaksi' => $transaksi->id,
                            'id_trip' => $transaksi->id_trip,
                            'nama' => $peserta['nama'],
                            'nomor_telepon' => $peserta['telepon'],
                            'email' => $peserta['email'],
                        ]);
                    }
                }
            }

        return redirect()->route('peserta.transaksi.index')->with('success', 'Transaksi berhasil dilakukan');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('trip', 'peserta', 'ulasan')
            ->where('id_user', Auth::id())
            ->findOrFail($id);

        // Jika belum punya token atau token sudah expired, generate baru
        if (!$transaksi->payment_token || $transaksi->status === 'expired') {

            $requestData = (object)[
                'order_id' => 'ORDER-' . $transaksi->id,
                'gross_amount' => (float) $transaksi->total ?: 10000,
                'first_name' => $transaksi->nama,
                'email' => filter_var($transaksi->email, FILTER_VALIDATE_EMAIL) ? $transaksi->email : 'backup@email.com',
                'phone' => $transaksi->nomor_telepon ?? '081234567890',
                'items' => [
                    [
                        'id' => $transaksi->id,
                        'name' => $transaksi->trip->nama_trip ?? 'Trip',
                        'price' => $transaksi->total,
                        'quantity' => 1,
                    ]
                ]
            ];

            $midtrans = new \App\Services\Midtrans\CreateSnapTokenService($requestData);
            $snapToken = $midtrans->getSnapToken();

            // Simpan token dan order ID ke database
            $transaksi->payment_order_id = $requestData->order_id;
            $transaksi->payment_token = $snapToken;
            $transaksi->status = 'pending';
            $transaksi->save();
        } else {
            $snapToken = $transaksi->payment_token;
        }

        return view('transaksi.detail-transaksi', compact('transaksi', 'snapToken'));
    }
    public function form($id)
    {
        $trip = Trip::findOrFail($id);

        return view('peserta.form', compact('trip'));
    }
}
