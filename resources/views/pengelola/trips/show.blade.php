@extends('layouts.dashboard')

@section('content')
<section class="pt-6 pb-16 bg-snow">
    <div class="max-w-7xl mx-auto px-6 space-y-12">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-pine">📌 Detail Trip</h1>
            <div class="space-x-2">
                <a href="{{ route('pengelola.trips.edit', $trip->id) }}"
                   class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md text-sm shadow">
                    ✏️ Edit
                </a>
                <form action="{{ route('pengelola.trips.destroy', $trip->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus trip ini?')" class="inline-block">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm shadow">
                        🗑️ Hapus
                    </button>
                </form>
            </div>
        </div>

        {{-- Gambar + Deskripsi --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <img src="{{ asset('storage/' . $trip->flyer) }}" alt="{{ $trip->nama_trip }}"
                class="w-full h-[360px] object-cover object-center">
            <div class="p-6 space-y-2">
                <h2 class="text-2xl font-bold text-pine">{{ $trip->nama_trip }}</h2>
                <p class="text-sm text-gray-700">{{ $trip->lokasi }}</p>
                <p class="text-sm text-gray-700">{{ $trip->deskripsi_trip }}</p>
                <p class="text-xs text-gray-400">Dibuat: {{ $trip->created_at->format('d M Y, H:i') }}</p>
                <p class="text-xs text-gray-400">Terakhir Diedit: {{ $trip->updated_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        {{-- Info Detail Trip --}}
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl shadow space-y-2 text-sm text-gray-800">
                <p><strong>📍 Meeting Point:</strong> {{ $trip->meeting_point }}</p>
                <p><strong>🗓️ Tanggal Trip:</strong> {{ \Carbon\Carbon::parse($trip->tanggal_mulai)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($trip->tanggal_selesai)->translatedFormat('d F Y') }}</p>
                <p><strong>⏱️ Waktu Mulai:</strong> {{ \Carbon\Carbon::parse($trip->waktu)->format('H:i') }} WIB</p>
                <p><strong>🧑‍🤝‍🧑 Kuota:</strong> {{ $trip->kuota }} peserta</p>
                <p><strong>📦 Durasi:</strong> {{ $trip->durasi ?? '-' }}</p>
                <p><strong>💰 Harga:</strong> Rp{{ number_format($trip->harga, 0, ',', '.') }}</p>
                <p><strong>💸 DP Dibayar:</strong> {{ $trip->dp_persen }}%</p>
                <p><strong>🗂️ Paket:</strong> {{ $trip->paket }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow space-y-2 text-sm text-gray-800">
                <p><strong>📎 Status:</strong> 
                    <span class="inline-block px-2 py-1 rounded-full text-xs {{ $trip->status === 'aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                        {{ ucfirst($trip->status) }}
                    </span>
                </p>
                <p><strong>🖼️ Nama Flyer:</strong> {{ $trip->flyer }}</p>
            </div>
        </div>

        {{-- Termasuk dan Tidak Termasuk --}}
        <div class="grid md:grid-cols-2 gap-6">
            @if($trip->sudah_termasuk)
            <div class="bg-white p-6 rounded-xl shadow space-y-2">
                <h3 class="text-emerald-600 font-semibold text-lg">✅ Sudah Termasuk</h3>
                <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                    @foreach (explode("\n", $trip->sudah_termasuk) as $item)
                        @if(trim($item) !== '')
                            <li>{{ $item }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            @endif

            @if($trip->belum_termasuk)
            <div class="bg-white p-6 rounded-xl shadow space-y-2">
                <h3 class="text-red-600 font-semibold text-lg">❌ Belum Termasuk</h3>
                <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                    @foreach (explode("\n", $trip->belum_termasuk) as $item)
                        @if(trim($item) !== '')
                            <li>{{ $item }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        {{-- Itinerary --}}
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-pine mb-2">📋 Itinerary</h3>
            <p class="text-sm text-gray-800 whitespace-pre-line">{{ $trip->itinerary }}</p>
        </div>
    </div>
</section>
@endsection
