@extends('layouts.dashboard')

@section('content')
<section class="pt-6 pb-10 bg-snow">
    <div class="max-w-6xl mx-auto px-4 md:px-6">
        <h1 class="text-2xl font-bold text-center text-pine mb-8">Riwayat Trip</h1>

       <form method="GET" action="{{ route('pengelola.trips.history') }}" class="mb-4 flex items-center gap-2">
            <label for="status" class="text-sm text-gray-700">Filter Status:</label>
            <select name="status" id="status" onchange="this.form.submit()"
                    class="px-3 py-2 border rounded-md text-sm">
                <option value="">Semua</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </form>

        <!-- Daftar Trip -->
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
            @foreach($trips as $trip)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="w-full h-40">
                        <img src="{{ asset('storage/' . $trip->flyer) }}" alt="{{ $trip->nama_trip }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 space-y-1">
                        <h2 class="text-lg font-semibold text-pine">{{ $trip->nama_trip }}</h2>
                        <p class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($trip->tanggal_trip)->translatedFormat('l, d M Y') }}</p>
                        <p class="text-sm text-gray-700">{{ $trip->lokasi }}</p>
                        <p class="text-sm text-gray-700">Waktu: {{ \Carbon\Carbon::parse($trip->waktu)->format('H:i') }}</p>
                        <p class="text-sm text-gray-700">Status: {{ ucfirst($trip->status) }}</p>
                        <a href="{{ route('pengelola.trips.show', $trip->id) }}" class="block text-center bg-pine text-white py-2 mt-3 rounded-md hover:bg-forest transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
