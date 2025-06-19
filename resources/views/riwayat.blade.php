<x-home-layout>
    <div class="pt-[80px] pb-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Main Content -->
            <div class="lg:w-3/4">
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="border-b px-6 py-4">
                        <h2 class="text-center text-xl font-semibold text-gray-900">Riwayat Pemesanan</h2>
                    </div>

                    <!-- Tabs -->
                    <div class="border-b">
                        <div class="flex px-6">
                            <button class="py-4 px-1 border-b-2 border-forest text-forest font-medium mr-8">
                                Pesanan 
                            </button>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="px-6 py-4 bg-snow border-b">
                        <div class="flex flex-wrap gap-3">
                            <button class="flex items-center px-4 py-2 bg-white border rounded-lg text-sm hover:bg-mist transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Filter
                            </button>
                            <button class="flex items-center px-4 py-2 bg-white border rounded-lg text-sm hover:bg-mist transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                                </svg>
                                Urutkan
                            </button>
                        </div>
                    </div>

                    <!-- Order History -->
                    <div class="divide-y">
                        @forelse ($transaksis as $transaksi)
                            <div class="p-6 hover:bg-mist transition-colors">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-snow rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-forest" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900">
                                                {{ $transaksi->trip->nama_trip ?? '-' }}
                                            </h3>
                                            <p class="text-sm">
                                                <span class="inline-block px-2 py-1 text-sm rounded text-forest">
                                                    {{ ucfirst($transaksi->status) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                        <a href="{{ route('peserta.transaksi.show', $transaksi->id) }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </button>
                                </div>
                                <div class="text-sm text-gray-600 space-y-1">
                                    <p>{{ \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('D, d M Y • H:i') }}</p>
                                    <p>Jalur Pendakian: {{ $transaksi->trip->jalur ?? '-' }} • {{ $transaksi->nama }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada transaksi</h3>
                                <p class="text-gray-500 text-sm mb-4">Belum ada transaksi yang tercatat.</p>
                                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-forest text-white rounded-lg hover:bg-moss transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Pesan Pendakian Sekarang
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
