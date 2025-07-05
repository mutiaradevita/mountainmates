@extends('layouts.dashboard')

@section('content')
<section class="pt-6 pb-10 bg-snow">
    <div class="max-w-5xl mx-auto px-6 space-y-12">

        {{-- Gambar + Nama + Deskripsi --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <img src="{{ asset('storage/' . $trip->flyer) }}" alt="{{ $trip->nama_trip }}"
                class="w-full h-48 object-cover">
            <div class="p-6 space-y-2">
                <h1 class="text-2xl font-bold text-pine">{{ $trip->nama_trip }}</h1>
                <p class="text-gray-700 text-sm">{{ $trip->deskripsi_trip }}</p>
            </div>
        </div>

        {{-- Highlights + Harga --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-mist p-4 rounded-lg shadow space-y-1">
                <h2 class="text-lg font-semibold text-forest mb-2">Highlights</h2>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li><strong>Meeting Point:</strong> {{ $trip->lokasi }}</li>
                    <li><strong>Tanggal Trip:</strong> {{ \Carbon\Carbon::parse($trip->tanggal_trip)->translatedFormat('l, d M Y') }}</li>
                    <li><strong>Waktu Mulai:</strong> {{ \Carbon\Carbon::parse($trip->waktu)->format('H:i') }}</li>
                    <li><strong>Kuota:</strong> {{ $trip->kuota }} peserta</li>
                    <li><strong>Durasi:</strong> {{ $trip->durasi ?? '-' }} hari</li>
                </ul>
            </div>
            <div class="bg-white p-4 rounded-lg shadow flex items-center justify-center">
                <div class="text-center">
                    <p class="text-sm text-gray-500 mb-1">Harga mulai dari</p>
                    <p class="text-2xl font-bold text-pine">Rp{{ number_format($trip->harga, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-700">
                    <p class="text-sm text-gray-700">DP yang harus dibayar: {{ $trip->dp_persen }}% </p>
                </div>
            </div>
        </div>


        {{-- Termasuk & Tidak Termasuk --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Sudah Termasuk --}}
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

            {{-- Belum Termasuk --}}
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

        <section class="bg-mist py-12 rounded-xl shadow">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-center text-pine mb-8">Ulasan dari Peserta</h2>

            @if($trip->pengelola && $trip->pengelola->ulasanDiberikan->count())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($trip->pengelola->ulasanDiberikan as $ulasan)
                        <div class="bg-white p-6 rounded-xl shadow">
                            <p class="text-gray-700 italic mb-3">“{{ $ulasan->komentar }}”</p>
                            <div class="text-sm text-gray-600">
                                <strong>{{ $ulasan->peserta->user->name ?? 'Anonim' }}</strong>
                                <div class="text-yellow-500">
                                    @for ($i = 1; $i <= 5; $i++)
                                        {{ $i <= $ulasan->rating ? '★' : '☆' }}
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600 italic">Belum ada ulasan untuk pengelola ini.</p>
            @endif
        </div>
    </section>
    </div>
</section>
@endsection
