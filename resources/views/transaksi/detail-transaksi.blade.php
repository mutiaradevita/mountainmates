<x-home-layout>
    <div class="pt-[80px] pb-12 bg-snow min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h2 class="text-2xl font-bold text-forest mb-6 border-b pb-3">Detail Riwayat Pemesanan</h2>

            <div class="mb-6 bg-white rounded-xl shadow border border-mist p-6 space-y-4 text-gray-800">
                <p>
                    <strong class="text-gray-600 w-40 inline-block">Trip:</strong>
                    <span class="font-medium">{{ $transaksi->trip->nama }}</span>
                </p>
                <p>
                    <strong class="text-gray-600 w-40 inline-block">Jumlah Peserta:</strong>
                    <span class="font-medium">{{ $transaksi->jumlah }}</span>
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
                    <span>{{ \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('d M Y, H:i') }}</span>
                </p>
            </div>

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
</x-home-layout>
