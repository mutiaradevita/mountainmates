<x-home-layout>
    <section class="pt-[80px] pb-12 bg-snow">
        <div class="max-w-7xl mx-auto px-6 space-y-12">
            <h1 class="text-2xl font-bold text-center text-pine">Riwayat Trip</h1>

            <!-- Filter Status Trip -->
            <form method="GET" action="{{ route('pengelola.trips.history') }}" class="mb-6">
                <div class="flex justify-between">
                    <div class="w-1/3">
                        <label class="block text-sm font-medium mb-1">Filter Berdasarkan Status</label>
                        <select name="status" class="w-full border border-gray-300 rounded-md p-2">
                            <option value="">Pilih Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="w-1/3">
                        <button type="submit" class="bg-forest text-white px-4 py-2 rounded-md w-full hover:bg-pine transition">
                            Filter
                        </button>
                    </div>
                </div>
            </form>

            <!-- Daftar Trip -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @foreach($trips as $trip)
                    <div class="w-full max-w-md mx-auto overflow-hidden rounded-xl mb-4 bg-white shadow-md">
                        <img src="{{ asset('storage/' . $trip->flyer) }}" alt="{{ $trip->nama_trip }}" class="w-full h-[150px] object-cover">
                        <h2 class="text-center text-xl font-bold text-pine mb-2">{{ $trip->nama_trip }}</h2>
                        <p class="text-gray-700">{{ \Carbon\Carbon::parse($trip->tanggal_trip)->translatedFormat('l, d M Y') }}</p>
                        <p class="text-gray-700">{{ $trip->lokasi }}</p>
                        <p class="text-gray-700">Status: {{ ucfirst($trip->status) }}</p> <!-- Status Trip -->
                        <a href="{{ route('pengelola.trips.show', $trip->id) }}" class="block text-center bg-pine text-white py-2 rounded-md mt-4">Lihat Detail</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-home-layout>
