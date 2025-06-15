<x-app-layout>
    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Trip</h1>

        <form action="{{ route('trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Trip --}}
                <div class="mb-4">
                    <label for="nama_trip" class="block text-gray-700">Nama Trip</label>
                    <input type="text" id="nama_trip" name="nama_trip" class="w-full px-4 py-2 border rounded-md" value="{{ $trip->nama_trip }}" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label for="deskripsi_trip" class="block text-gray-700">Deskripsi</label>
                    <textarea id="deskripsi_trip" name="deskripsi_trip" class="w-full px-4 py-2 border rounded-md" required>{{ $trip->deskripsi_trip }}</textarea>
                </div>

                {{-- Jadwal --}}
                <div class="mb-4 md:col-span-2">
                    <label for="jadwal" class="block text-gray-700">Jadwal</label>
                    <input type="text" id="jadwal_trip" name="jadwal_trip" class="w-full px-4 py-2 border rounded-md" value="{{ $trip->jadwal_trip }}" required>
                </div>

                {{-- Itinerary --}}
                <div class="mb-4 md:col-span-2">
                    <label for="itinerary" class="block text-gray-700">Itinerary</label>
                    <textarea id="itinerary" name="itinerary" class="w-full px-4 py-2 border rounded-md" rows="5" required>{{ $trip->itinerary }}</textarea>
                </div>

                {{-- Tanggal --}}
                <div class="mb-4">
                    <label for="tanggal_trip" class="block text-gray-700">Tanggal Trip</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($trip->tanggal)->format('Y-m-d')) }}" class="w-full border border-gray-300 rounded-md p-2" required>
                </div>

                {{-- Tipe Trip --}}
                <div class="mb-4">
                    <label for="tipe_trip" class="block text-gray-700">Tipe Trip</label>
                    <select id="tipe_trip" name="tipe_trip" class="w-full px-4 py-2 border rounded-md" required>
                        <option value="open" {{ $trip->tipe_trip === 'open' ? 'selected' : '' }}>Open Trip</option>
                        <option value="private" {{ $trip->tipe_trip === 'private' ? 'selected' : '' }}>Private Trip</option>
                    </select>
                </div>

                {{-- Waktu --}}
                <div class="mb-4">
                    <label for="waktu" class="block text-gray-700">Waktu Mulai</label>
                    <input type="time" id="waktu" name="waktu" class="w-full px-4 py-2 border rounded-md" value="{{ $trip->waktu }}" required>
                </div>

                {{-- Lokasi --}}
                <div class="mb-4">
                    <label for="lokasi" class="block text-gray-700">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" class="w-full px-4 py-2 border rounded-md" value="{{ $trip->lokasi }}" required>
                </div>

                {{-- Kuota --}}
                <div class="mb-4">
                    <label for="kuota" class="block text-gray-700">Kuota Peserta</label>
                    <input type="number" id="kuota" name="kuota" class="w-full px-4 py-2 border rounded-md" value="{{ $trip->kuota }}" required>
                </div>

                {{-- Harga --}}
                <div class="mb-4">
                    <label for="harga" class="block text-gray-700">Harga</label>
                    <input type="number" id="harga" name="harga" class="w-full px-4 py-2 border rounded-md" value="{{ $trip->harga }}" required>
                </div>

                {{-- Flyer --}}
                <div class="mb-4">
                    <label for="flyer" class="block text-gray-700">Foto Trip / Flyer</label>
                    <input type="file" id="flyer" name="flyer" class="w-full px-4 py-2 border rounded-md">
                    <small class="text-sm text-gray-500">Biarkan kosong jika tidak ingin mengganti.</small>
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select name="status" id="status" class="w-full px-4 py-2 border rounded-md" required>
                        <option value="aktif" {{ $trip->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ $trip->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="mt-6 py-2 px-6 bg-pine text-snow rounded-lg hover:bg-pine">Update Trip</button>
        </form>
    </div>
</x-app-layout>
