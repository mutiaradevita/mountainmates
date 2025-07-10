@extends('layouts.app')

@section('content')

<div class="bg-snow min-h-[calc(100vh-100px)] py-8 px-4">
    <div class="max-w-4xl mx-auto px-4 md:px-6">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-xl p-8 space-y-6">

            {{-- Judul --}}
            <h2 class="text-3xl font-bold text-center text-pine mb-6">🧭 Detail Riwayat Pemesanan</h2>

            {{-- Info Trip --}}
            <div class="grid md:grid-cols-2 gap-6 text-sm text-gray-800">
                <div>
                    <p class="mb-2"><span class="font-semibold text-gray-600">Trip:</span> {{ $transaksi->trip->nama_trip ?? '-' }}</p>
                    <p class="mb-2"><span class="font-semibold text-gray-600">Jumlah Peserta:</span> {{ $transaksi->jumlah_peserta }}</p>
                    <p class="mb-2"><span class="font-semibold text-gray-600">Total:</span> <span class="text-lg font-bold text-forest">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span></p>
                    <p class="text-sm text-gray-700">DP yang harus dibayar: {{ $transaksi->trip->dp_persen }}% dari total</p>
                </div>
                <div>
                    @php
                        $statusTripClass = match($transaksi->status) {
                            'menunggu' => 'bg-yellow-100 text-yellow-700',
                            'selesai' => 'bg-green-100 text-green-700',
                            'berlangsung' => 'bg-blue-100 text-blue-700',
                            'batal' => 'bg-red-100 text-red-700',
                            default => 'bg-gray-100 text-gray-600'
                        };
                    @endphp

                    <p class="mb-2">
                        <span class="font-semibold text-gray-600">Status Trip:</span>
                        <span class="inline-block text-xs font-medium px-3 py-1 rounded-full {{ $statusTripClass }}">
                            {{ ucfirst($transaksi->status) }}
                        </span>
                    </p>

                    @php
                        $statusPembayaranClass = match($transaksi->status_pembayaran) {
                            'dp' => 'bg-yellow-100 text-yellow-700',
                            'lunas' => 'bg-green-100 text-green-700',
                            'batal' => 'bg-red-100 text-red-700',
                            default => 'bg-gray-100 text-gray-600'
                        };
                    @endphp

                    <p class="mb-2">
                        <span class="font-semibold text-gray-600">Status Pembayaran:</span>
                        <span class="inline-block text-xs font-medium px-3 py-1 rounded-full {{ $statusPembayaranClass }}">
                            {{ ucfirst($transaksi->status_pembayaran) }}
                        </span>
                    </p>

                    <p class="mb-2"><span class="font-semibold text-gray-600">Tanggal Trip:</span> 
                        {{ \Carbon\Carbon::parse($transaksi->trip->tanggal_mulai)->translatedFormat('D, d M Y') }} 
                        s.d 
                        {{ \Carbon\Carbon::parse($transaksi->trip->tanggal_selesai)->translatedFormat('D, d M Y') }}
                    </p>
                    <p class="mb-2"><span class="font-semibold text-gray-600">Tanggal Pesan:</span> 
                        {{ \Carbon\Carbon::parse($transaksi->created_at)->timezone('Asia/Jakarta')->translatedFormat('D, d M Y • H:i') }}
                    </p>
                </div>
            </div>

           {{-- Daftar Peserta --}}
           @if ($transaksi->peserta->count())
                <div class="border-t pt-6">
                    <h3 class="font-semibold text-pine text-lg mb-3">👥 Daftar Peserta</h3>

                    <div class="max-h-60 overflow-y-auto pr-2">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                            @foreach ($transaksi->peserta as $p)
                                <div class="border p-3 rounded-md bg-white shadow-sm">
                                    <div class="font-semibold text-pine">{{ $loop->iteration }}. {{ $p->nama }}</div>
                                    @if($p->nomor_telepon)
                                        <div class="text-gray-500 text-sm">📞 {{ $p->nomor_telepon }}</div>
                                    @endif
                                    @if($p->email)
                                        <div class="text-gray-500 text-sm">📧 {{ $p->email }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- Tombol Aksi --}}
            <div class="border-t pt-6 space-y-4">
                @if(isset($snapToken) && $transaksi->status_pembayaran === 'menunggu dp')
                <button id="pay-button" class="w-full bg-forest text-white px-5 py-3 rounded-lg hover:bg-pine transition font-semibold">
                    💳 Bayar Sekarang
                </button>
                 <p class="text-xs text-gray-500 text-center">Lakukan pembayaran untuk menyelesaikan pemesananmu.</p>
                @endif

                @if ($transaksi->status_pembayaran === 'dp' && $showPelunasanButton)
                    <a href="{{ route('peserta.transaksi.bayar-pelunasan', $transaksi->id) }}"
                        class="w-full bg-forest text-white px-5 py-3 rounded-lg hover:bg-pine transition font-semibold block text-center">
                        🔁 Bayar Pelunasan
                    </a>
                     <p class="text-xs text-gray-500 text-center">Lakukan pembayaran untuk menyelesaikan pemesananmu.</p>
                @endif

                @if(in_array($transaksi->status_pembayaran, ['dp', 'lunas']))
                    <a href="{{ route('invoice.generate', $transaksi->id) }}" target="_blank"
                        class="w-full bg-pine border border-pine text-white px-4 py-2 rounded-lg hover:bg-pine hover:text-white transition text-center font-semibold block">
                        🧾 Download Invoice
                    </a>
                @endif

                @if (in_array($transaksi->status, ['menunggu', 'dp']))
                    <form action="{{ route('peserta.transaksi.batalkan', $transaksi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                        @csrf
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-lg transition font-semibold">
                            ❌ Batalkan Pesanan
                        </button>
                    </form>
                @endif

                @if ($transaksi->status === 'selesai')
                    @if (!$transaksi->ulasan)
                        <a href="{{ route('peserta.ulasan.create', $transaksi->id) }}"
                            class="w-full inline-block text-center bg-pine text-white px-5 py-3 rounded-lg hover:bg-forest transition font-semibold">
                            ✍️ Beri Ulasan
                        </a>
                    @else
                        <div class="bg-mist text-gray-700 p-4 rounded-lg">
                            <h3 class="font-semibold text-pine mb-2">💬 Ulasan Kamu:</h3>
                            <p class="italic">"{{ $transaksi->ulasan->komentar }}"</p>
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="text-xl {{ $i <= $transaksi->ulasan->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                            @endfor
                        </div>
                    @endif
                @endif

                <a href="{{ route('peserta.transaksi.index') }}"
                    class="w-full inline-flex items-center justify-center px-5 py-3 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700 text-sm font-medium transition">
                    ⬅️ Kembali ke Riwayat
                </a>
            </div>

        </div>
    </div>
</div>

{{-- Midtrans Script --}}
@if(isset($snapToken) && $transaksi->status !== 'selesai')
<script type="text/javascript" src="{{ config('midtrans.snap_url') }}"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const payBtn = document.getElementById("pay-button");
        if (payBtn) {
            payBtn.addEventListener("click", function (e) {
                e.preventDefault();
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function () {
                        alert("Pembayaran berhasil!");
                        location.reload();
                    },
                    onPending: function () {
                        alert("Pembayaran tertunda.");
                    },
                    onError: function () {
                        alert("Pembayaran gagal.");
                    },
                    onClose: function () {
                        alert("Popup pembayaran ditutup.");
                    }
                });
            });
        }
    });
</script>
@endif
@endsection
