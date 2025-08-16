@extends('layouts.app')

@section('content')
<section class="pt-6 pb-16 bg-snow">
    <div class="max-w-6xl mx-auto px-6 space-y-12">

        {{-- Gambar + Nama + Deskripsi --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <img src="{{ asset('storage/' . $trip->flyer) }}" alt="{{ $trip->nama_trip }}"
                class="w-full h-[360px] object-cover object-center">
            <div class="p-6 space-y-2">
                <h1 class="text-2xl font-bold text-pine">{{ $trip->nama_trip }}</h1>
                <p class="text-gray-700 text-sm">{{ $trip->lokasi }}</p>
                <p class="text-gray-700 text-sm">{{ $trip->deskripsi_trip }}</p>
            </div>
        </div>

        {{-- Lokasi Trip --}}
        @if($trip->latitude && $trip->longitude)
        <div class="bg-white rounded-xl shadow overflow-hidden mb-6">
            <div id="map" style="height: 350px; width: 100%; border-radius: 8px;"></div>
        </div>
        @endif

        {{-- Highlights + Harga --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-mist p-4 rounded-lg shadow space-y-1">
                <h2 class="text-lg font-semibold text-forest mb-2">Highlights</h2>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li><strong>Meeting Point:</strong> {{ $trip->meeting_point }}</li>
                    <li>
                        <strong>Tanggal Trip:</strong>
                        {{ \Carbon\Carbon::parse($trip->tanggal_mulai)->translatedFormat('d M Y') }} -
                        {{ \Carbon\Carbon::parse($trip->tanggal_selesai)->translatedFormat('d M Y') }}
                    </li>
                    <li><strong>Waktu Mulai:</strong> {{ \Carbon\Carbon::parse($trip->waktu)->format('H:i') }} WIB</li>
                    <li><strong>Kuota:</strong> {{ $trip->kuota }} peserta</li>
                    <li><strong>Durasi:</strong> {{ $trip->durasi ?? '-' }}</li>
                </ul>
            </div>
            <div class="bg-white p-4 rounded-lg shadow flex items-center justify-center">
                <div class="text-center">
                    <p class="text-sm text-gray-500 mb-1">Harga mulai dari</p>
                    <p class="text-2xl font-bold text-pine">Rp{{ number_format($trip->harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- Termasuk & Tidak Termasuk --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @if($trip->sudah_termasuk)
            <div class="bg-white p-4 rounded-xl shadow">
                <h3 class="text-forest font-semibold mb-2">✅ Sudah Termasuk</h3>
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
            <div class="bg-white p-4 rounded-xl shadow">
                <h3 class="text-forest font-semibold mb-2">❌ Belum Termasuk</h3>
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
        <div class="bg-mist p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-forest mb-2">Itinerary</h3>
            <p class="text-sm text-gray-800 whitespace-pre-line">{{ $trip->itinerary }}</p>
        </div>

        {{-- Tombol Pesan --}}
        <div class="text-center">
            <a href="{{ route('peserta.peserta.form', $trip->id) }}" class="bg-forest text-white px-6 py-3 rounded-md inline-block hover:bg-pine transition font-semibold">
                Pesan Sekarang
            </a>
        </div>

    </div>
</section>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    @if($trip->latitude && $trip->longitude)
        var map = L.map('map').setView([{{ $trip->latitude }}, {{ $trip->longitude }}], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([{{ $trip->latitude }}, {{ $trip->longitude }}])
            .addTo(map)
            .bindPopup('{{ $trip->lokasi }}')
            .openPopup();

        // Pastikan peta menyesuaikan ukuran container
        setTimeout(function() {
            map.invalidateSize();
        }, 200);
    @endif
});
</script>
