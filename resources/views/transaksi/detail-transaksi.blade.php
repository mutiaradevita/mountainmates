<x-home-layout>
     <div class="pt-[80px] pb-12 bg-snow min-h-screen">
        <div class="max-w-xl mx-auto px-4 py-8 bg-white shadow rounded-xl">
            <h2 class="text-center text-2xl font-bold text-forest mb-6 border-b pb-3">Detail Riwayat Pemesanan</h2>

            <div class="mb-6 bg-white rounded-xl shadow border border-mist p-6 space-y-4 text-gray-800">
                <p>
                    <strong class="text-gray-600 w-40 inline-block">Trip:</strong>
                    <span class="font-medium">{{ $transaksi->trip->nama_trip ?? '-' }}</span>
                </p>
                <p>
                    <strong class="text-gray-600 w-40 inline-block">Jumlah Peserta:</strong>
                    <span class="font-medium">{{ $transaksi->jumlah_peserta }}</span>
                </p>
                <p>
                    <strong class="text-gray-600 w-40 inline-block">Total:</strong>
                    <span class="font-semibold text-forest">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                </p>
                <p>
                    <strong class="text-gray-600 w-40 inline-block">Status:</strong>
                    <span class="px-2 py-1 rounded text-white bg-forest text-sm">
                        {{ ucfirst($transaksi->status) }}
                    </span>
                </p>
                <p>
                    <strong class="text-gray-600 w-40 inline-block">Tanggal Pesan:</strong>
                    <span>{{ \Carbon\Carbon::parse($transaksi->created_at)->timezone('Asia/Jakarta')->translatedFormat('D, d M Y • H:i') }}</span>
                </p>

                @if ($transaksi->peserta->count())
                    <div class="pt-4 border-t mt-6">
                        <p class="font-semibold text-forest mb-2">Daftar Peserta:</p>
                        <ol class="list-decimal list-inside text-gray-700 space-y-2">
                            @foreach ($transaksi->peserta as $p)
                                <li>
                                    <div class="font-medium">{{ $p->nama }}</div>
                                    @if($p->nomor_telepon) <div class="text-sm text-gray-500">HP: {{ $p->nomor_telepon }}</div> @endif
                                    @if($p->email) <div class="text-sm text-gray-500">Email: {{ $p->email }}</div> @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @endif

                  {{-- Tombol Midtrans --}}
                @if(isset($snapToken) && $transaksi->status !== 'selesai')
                    <button id="pay-button"
                        class="inline-block bg-forest text-white px-4 py-2 rounded hover:bg-pine transition">
                        Bayar Sekarang
                    </button>
                @endif

            @if ($transaksi->status === 'selesai')
                @if (!$transaksi->ulasan)
                    <div class="mt-6">
                        <a href="{{ route('peserta.ulasan.create', $transaksi->id) }}"
                        class="inline-block bg-pine text-snow px-4 py-2 rounded hover:bg-forest transition">
                            Beri Ulasan
                        </a>
                    </div>
                @else
                    <div class="mt-6 bg-mist p-4 rounded">
                        <h3 class="font-semibold text-pine mb-2">Ulasan Kamu:</h3>
                        <p class="text-gray-800">"{{ $transaksi->ulasan->komentar }}"</p>
                    </div>
                @endif
            @endif

            <a href="{{ route('peserta.transaksi.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-sm text-gray-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Riwayat
            </a>
        </div>
    </div>

    {{-- Midtrans Script di bagian luar layout utama --}}
    @if(isset($snapToken) && $transaksi->status !== 'selesai')
        <script type="text/javascript" src="{{ config('midtrans.snap_url') }}"
            data-client-key="{{ config('midtrans.client_key') }}"></script>

        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function () {
                const payBtn = document.getElementById("pay-button");
                if (payBtn) {
                    payBtn.addEventListener("click", function (e) {
                        e.preventDefault();
                        window.snap.pay('{{ $snapToken }}', {
                            onSuccess: function (result) {
                                alert("Pembayaran berhasil!");
                                location.reload();
                            },
                            onPending: function (result) {
                                alert("Pembayaran tertunda.");
                            },
                            onError: function (result) {
                                alert("Pembayaran gagal.");
                            },
                            onClose: function () {
                                alert("Anda menutup popup pembayaran.");
                            }
                        });
                    });
                }
            });
        </script>
    @endif
</x-home-layout>


