@extends('layouts.app')

@section('content')
<div class="bg-snow min-h-[calc(100vh-100px)] py-8 px-4">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6 x-data="{ status: 'all' }">

        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <!-- Header -->
            <div class="border-b px-6 py-4 bg-white">
                <h2 class="text-center text-2xl font-bold text-forest">Riwayat Pemesanan</h2>
            </div>

            <!-- Filter -->
            <div x-data="{ status: 'all' }">
            <div class="px-6 py-4 bg-snow border-b">
                <div class="flex flex-wrap gap-3 justify-center">
                    <button @click="status = 'all'" :class="status === 'all' ? 'bg-forest text-white' : 'bg-white text-gray-700'"
                        class="px-4 py-2 border rounded-lg text-sm hover:bg-forest transition">
                        Semua
                    </button>
                    <button @click="status = 'menunggu'" :class="status === 'menunggu' ? 'bg-yellow-100 text-yellow-700' : 'bg-white text-gray-700'"
                        class="px-4 py-2 border rounded-lg text-sm hover:bg-yellow-100 transition">
                        Menunggu
                    </button>
                    <button @click="status = 'selesai'" :class="status === 'selesai' ? 'bg-green-100 text-green-700' : 'bg-white text-gray-700'"
                        class="px-4 py-2 border rounded-lg text-sm hover:bg-green-100 transition">
                        Selesai
                    </button>
                    <button @click="status = 'batal'" :class="status === 'batal' ? 'bg-red-100 text-red-700' : 'bg-white text-gray-700'"
                        class="px-4 py-2 border rounded-lg text-sm hover:bg-red-100 transition">
                        Batal
                    </button>
                    <button @click="status = 'berlangsung'" :class="status === 'berlangsung' ? 'bg-blue-100 text-blue-700' : 'bg-white text-gray-700'"
                        class="px-4 py-2 border rounded-lg text-sm hover:bg-blue-100 transition">
                        Berlangsung
                    </button>
                </div>
            </div>

            <!-- List Transaksi -->
            <div class="divide-y">
                @forelse ($transaksis as $transaksi)
                    <div 
                        x-show="status === 'all' || status === '{{ $transaksi->status }}'"
                        class="p-6 hover:bg-mist transition-all duration-200"
                    >
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-x-4">
                                <div class="w-10 h-10 bg-snow rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-forest" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold text-gray-900">
                                        {{ $transaksi->trip->nama_trip ?? '-' }}
                                    </h3>
                                   @php
                                        $statusClass = match($transaksi->status) {
                                            'menunggu' => 'bg-yellow-100 text-yellow-700',
                                            'selesai' => 'bg-green-100 text-green-700',
                                            'berlangsung' => 'bg-blue-100 text-blue-700',
                                            'batal'   => 'bg-red-100 text-red-700',
                                            default   => 'bg-gray-100 text-gray-600',
                                        };
                                    @endphp

                                    <span class="text-xs inline-block mt-1 px-3 py-1 rounded-full font-medium {{ $statusClass }}">
                                        {{ ucfirst($transaksi->status) }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('peserta.transaksi.show', $transaksi->id) }}"
                                class="text-forest hover:text-pine transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        <p class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($transaksi->created_at)->timezone('Asia/Jakarta')->translatedFormat('D, d M Y • H:i') }}
                        </p>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada transaksi</h3>
                        <p class="text-gray-500 text-sm mb-4">Yuk mulai pesan trip pendakian pertama kamu!</p>
                        <a href="{{ route('jelajah') }}"
                            class="inline-flex items-center px-4 py-2 bg-forest text-white rounded-lg hover:bg-pine transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Pesan Sekarang
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
