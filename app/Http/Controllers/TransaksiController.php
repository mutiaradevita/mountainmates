<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\PesertaTransaksi;
use App\Models\Trip;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $transaksis = Transaksi::with('trip')
            ->where('id_user', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($transaksis as $trx) {
            $this->updateStatusTransaksi($trx);
        }

        return view('riwayat', compact('transaksis'));
    }

    public function store(Request $request)
    {
        if ($request->jumlah_peserta && empty($request->peserta)) {
            return back()->withInput()->withErrors([
                'peserta' => 'Data peserta harus diisi sesuai jumlah.'
            ]);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'jumlah_peserta' => 'required|integer|min:1',
            'paket' => 'nullable|string',
            'peserta.*.nama' => 'required|string|max:255',
            'peserta.*.telepon' => 'required|string|max:20',
            'peserta.*.email' => 'required|email|max:255',
            'id_trip' => 'required|exists:trips,id', 
        ]);

            $trip = Trip::findOrFail($request->id_trip);
            $total = $trip->harga * $request->jumlah_peserta;

            $dpPersen = $trip->dp_persen ?? 30;
            $dpAmount = round($total * ($dpPersen / 100), 2);

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
            $transaksi->total_dp = $dpAmount;
            $transaksi->status = 'menunggu';
            $transaksi->status_pembayaran = 'menunggu dp';

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

        $this->updateStatusTransaksi($transaksi);

        $showPelunasanButton = false;

        if ($transaksi->status_pembayaran === 'dp' && $transaksi->trip && $transaksi->trip->tanggal_mulai) {
            $tanggalTrip = Carbon::parse($transaksi->trip->tanggal_mulai)->startOfDay();
            $hariIni = Carbon::now()->timezone('Asia/Jakarta')->startOfDay();

            $selisihHari = $hariIni->diffInDays($tanggalTrip, false);

            if ($selisihHari <= 7 && $hariIni->lte($tanggalTrip)) {
                $showPelunasanButton = true;
            }
        }

        // Jika belum punya token atau status expired, generate baru
        if (!$transaksi->payment_token || $transaksi->status === 'expired') {
            $requestData = (object)[
                'order_id' => (string) Str::ulid(),
                'gross_amount' => (float) $transaksi->total_dp ?: 10000,
                'first_name' => $transaksi->nama,
                'email' => filter_var($transaksi->email, FILTER_VALIDATE_EMAIL) ? $transaksi->email : 'backup@email.com',
                'phone' => $transaksi->nomor_telepon ?? '081234567890',
                'items' => [
                    [
                        'id' => $transaksi->id,
                        'name' => $transaksi->trip->nama_trip ?? 'Trip',
                        'price' => $transaksi->total_dp,
                        'quantity' => 1,
                    ]
                ]
            ];

            $midtrans = new CreateSnapTokenService($requestData);
            $snapToken = $midtrans->getSnapToken();

            $transaksi->payment_order_id = $requestData->order_id;
            $transaksi->payment_token = $snapToken;
        } else {
            $snapToken = $transaksi->payment_token;
        }

        $transaksi->save();

        return view('transaksi.detail-transaksi', compact('transaksi', 'snapToken', 'showPelunasanButton'));
    }


    public function form($id)
    {
        $trip = Trip::findOrFail($id);

        return view('peserta.form', compact('trip'));
    }

    public function bayarPelunasan($id)
    {
        $transaksi = Transaksi::with('trip')->where('id_user', Auth::id())->findOrFail($id);

        if ($transaksi->status_pembayaran !== 'dp') {
            return redirect()->route('peserta.transaksi.index')->with('error', 'Pelunasan tidak diperlukan.');
        }

        $sisa = $transaksi->total - $transaksi->total_dp;

        $requestData = (object)[
            'order_id' => 'pelunasan-' . (string) Str::ulid(),
            'gross_amount' => (float) $sisa,
            'first_name' => $transaksi->nama,
            'email' => filter_var($transaksi->email, FILTER_VALIDATE_EMAIL) ? $transaksi->email : 'backup@email.com',
            'phone' => $transaksi->nomor_telepon ?? '081234567890',
            'items' => [
                [
                    'id' => $transaksi->id . '-pelunasan',
                    'name' => 'Pelunasan ' . ($transaksi->trip->nama_trip ?? 'Trip'),
                    'price' => $sisa,
                    'quantity' => 1,
                ]
            ]
        ];

        $midtrans = new CreateSnapTokenService($requestData);
        $snapToken = $midtrans->getSnapToken();

        // Simpan token pelunasan
        $transaksi->pelunasan_order_id = $requestData->order_id;
        $transaksi->pelunasan_token = $snapToken;
        $transaksi->total_pelunasan = $sisa;
        $transaksi->save();

        return view('transaksi.bayar-pelunasan', compact('transaksi', 'snapToken'));
    }
    public function batalkan($id)
    {
        $transaksi = Transaksi::where('id_user', Auth::id())->findOrFail($id);

        if (!in_array($transaksi->status, ['menunggu', 'dp'])) {
            return back()->with('error', 'Pesanan tidak bisa dibatalkan pada status ini.');
        }

        $transaksi->status = 'batal';
        $transaksi->save();

        return redirect()->route('peserta.transaksi.index')->with('success', 'Pesanan berhasil dibatalkan.');
    }   
    private function updateStatusTransaksi($trx)
    {
        $trip = $trx->trip;
        $today = Carbon::now()->timezone('Asia/Jakarta')->startOfDay();

        if (!$trip || !$trip->tanggal_mulai || !$trip->tanggal_selesai) return;

        if (in_array($trx->status_pembayaran, ['dp', 'menunggu dp']) && $today->gte(Carbon::parse($trip->tanggal_mulai))) {
            $trx->update([
                'status' => 'tidak ikut',
                'status_pembayaran' => 'batal',
            ]);
        } elseif (
            $trx->status === 'menunggu' &&
            $trx->status_pembayaran === 'lunas' &&
            $trip->tanggal_mulai <= $today &&
            $trip->tanggal_selesai >= $today
        ) {
            $trx->update(['status' => 'berlangsung']);
        } elseif (
            $trx->status === 'berlangsung' &&
            $today->gt(Carbon::parse($trip->tanggal_selesai))
        ) {
            $trx->update(['status' => 'selesai']);
        }
    }
}

