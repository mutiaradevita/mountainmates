<x-app-layout>
    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Dashboard Pengelola</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-gray-700 text-lg font-semibold mb-2">Trip Aktif</h2>
                <p class="text-4xl font-bold text-blue-600">{{ $activeTripsCount }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-gray-700 text-lg font-semibold mb-2">Trip Selesai</h2>
                <p class="text-4xl font-bold text-green-600">{{ $completedTripsCount }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-gray-700 text-lg font-semibold mb-2">Total Peserta</h2>
                <p class="text-4xl font-bold text-purple-600">{{ $participantsCount }}</p>
            </div>
        </div>

        <div class="mt-10">
            <h2 class="text-xl font-semibold mb-4">Trip Terbaru</h2>
            <ul class="space-y-4">
                @forelse ($latestTrips as $trip)
                    <li class="bg-white shadow rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-bold">{{ $trip->nama_trip }}</h3>
                                <p class="text-sm text-gray-600">{{ $trip->lokasi }} - {{ \Carbon\Carbon::parse($trip->tanggal_mulai)->format('d M Y') }}</p>
                            </div>
                            <span class="text-sm px-2 py-1 rounded-full 
                                {{ $trip->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                                {{ ucfirst($trip->status) }}
                            </span>
                        </div>
                    </li>
                @empty
                    <li class="text-gray-600">Belum ada trip yang dibuat.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
