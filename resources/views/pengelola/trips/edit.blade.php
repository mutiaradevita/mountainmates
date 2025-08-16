@extends('layouts.dashboard')

@section('content')
<div class="pt-6 pb-10">
    <h1 class="text-center text-3xl font-bold mb-6">Edit Trip</h1>
    <form action="{{ route('pengelola.trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Trip --}}
            <div class="mb-4">
                <label for="nama_trip" class="block text-gray-700">Nama Trip</label>
                <input type="text" id="nama_trip" name="nama_trip" class="w-full px-4 py-2 border rounded-md" value="{{ $trip->nama_trip }}" required>
            </div>

             {{-- Kuota --}}
            <div class="mb-4">
                <label for="kuota" class="block text-gray-700">Kuota Peserta</label>
                <input type="number" id="kuota" name="kuota" class="w-full px-4 py-2 border rounded-md" value="{{ $trip->kuota }}" required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4 md:col-span-2">
                <label for="deskripsi_trip" class="block text-gray-700">Deskripsi Trip</label>
                <textarea id="deskripsi_trip" name="deskripsi_trip" class="w-full px-4 py-2 border rounded-md" required>{{ $trip->deskripsi_trip }}</textarea>
            </div>

            {{-- Lokasi Gunung (daerah pendakian) --}}
            <div class="mb-4 md:col-span-2">
                <label for="lokasi_map" class="block text-gray-700">Lokasi Gunung</label>
                <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $trip->lokasi ?? '') }}" required placeholder="Contoh: Malang" class="form-input w-full px-4 py-2 border rounded-md mb-3">
                <div id="map" style="height: 300px; width: 100%; border-radius: 8px;"></div>
                <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude', $trip->latitude ?? '') }}">
                <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude', $trip->longitude ?? '') }}">
            </div>

            {{-- Meeting Point --}}
            <div class="mb-4">
                <label for="meeting_point" class="block text-gray-700">Meeting Point</label>
                <input type="text" id="meeting_point" name="meeting_point" class="w-full px-4 py-2 border rounded-md" 
                    value="{{ old('meeting_point', $trip->meeting_point ?? '') }}" required>
            </div>

            {{-- Harga --}}
            <div class="mb-4">
                <label for="harga" class="block text-gray-700">Harga</label>
                <input type="number" id="harga" name="harga" class="w-full px-4 py-2 border rounded-md" value="{{ $trip->harga }}" required>
            </div>

            <div class="mb-4">
                <label for="dp_persen" class="block font-semibold mb-1">Persentase DP (%)</label>
                <input type="number" name="dp_persen" id="dp_persen" min="0" max="100" class="w-full border rounded p-2"
                    value="{{ old('dp_persen', $trip->dp_persen ?? 30) }}">
            </div>

            {{-- Waktu Mulai --}}
            <div class="mb-4">
                <label for="waktu" class="block text-gray-700">Waktu Mulai</label>
                <input type="time" id="waktu" name="waktu" class="w-full px-4 py-2 border rounded-md" value="{{ old('waktu', \Carbon\Carbon::createFromFormat('H:i:s', $trip->waktu)->format('H:i')) }}" required>
            </div>

            {{-- Durasi --}}
            <div class="mb-4">
                <label for="durasi" class="block text-gray-700">Durasi</label>
                <input type="text" id="durasi" name="durasi" class="w-full px-4 py-2 border rounded-md" value="{{ $trip->durasi }}">
            </div>

            {{-- Paket Tersedia --}}
            <div class="mb-4">
                <label for="paket" class="block text-gray-700">Paket Tersedia <small>(pisahkan dengan koma: regular,vip)</small></label>
                <input type="text" id="paket" name="paket" class="w-full px-4 py-2 border rounded-md" value="{{ $trip->paket }}">
            </div>

            {{-- Sudah Termasuk --}}
            <div class="mb-4 md:col-span-2">
                <label for="sudah_termasuk" class="block text-gray-700">✅ Sudah Termasuk</label>
                <textarea id="sudah_termasuk" name="sudah_termasuk" class="w-full px-4 py-2 border rounded-md" rows="4">{{ old('sudah_termasuk', $trip->sudah_termasuk) }}</textarea>
            </div>

            {{-- Belum Termasuk --}}
            <div class="mb-4 md:col-span-2">
                <label for="belum_termasuk" class="block text-gray-700">❌ Belum Termasuk</label>
                <textarea id="belum_termasuk" name="belum_termasuk" class="w-full px-4 py-2 border rounded-md" rows="4">{{ old('belum_termasuk', $trip->belum_termasuk) }}</textarea>
            </div>

            {{-- Jadwal Trip --}}
            <div class="mb-4 md:col-span-2">
                <label class="block text-gray-700 mb-2">Jadwal Trip Tersedia</label>

                <div class="flex items-center gap-4 mb-2">
                    <input type="date" name="tanggal_mulai" class="px-2 py-1 border rounded w-full"
                        value="{{ old('tanggal_mulai', $trip->tanggal_mulai) }}" required>

                    <span class="text-gray-500">s/d</span>

                    <input type="date" name="tanggal_selesai" class="px-2 py-1 border rounded w-full"
                        value="{{ old('tanggal_selesai', $trip->tanggal_selesai) }}" required>
                </div>
            </div>

            {{-- Itinerary --}}
            <div class="mb-4 md:col-span-2">
                <label for="itinerary" class="block text-gray-700">Itinerary</label>
                <textarea id="itinerary" name="itinerary" class="w-full px-4 py-2 border rounded-md" rows="5" required>{{ $trip->itinerary }}</textarea>
            </div>

            {{-- Flyer --}}
            <div class="mb-4">
                <label for="flyer" class="block text-gray-700">Foto Trip</label>
                <input type="file" id="flyer" name="flyer" class="w-full px-4 py-2 border rounded-md">
                <small class="text-sm text-gray-500">Biarkan kosong jika tidak ingin mengganti.</small>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status Trip</label>
                <select name="status" id="status" class="w-full px-4 py-2 border rounded-md" required>
                    <option value="" disabled {{ old('status', $trip->status) === null ? 'selected' : '' }}>-- Pilih Status --</option>
                    <option value="aktif" {{ $trip->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ $trip->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </div>

         @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif 

        <div class="mt-6 flex justify-end">
            <button type="submit" class="py-2 px-6 bg-pine text-snow rounded-lg hover:bg-forest">
                Update Trip
            </button>
        </div>
    </form>
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    var map = L.map('map').setView([-2.5489, 118.0149], 5); 

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker;
    var latInput = document.getElementById('latitude');
    var lngInput = document.getElementById('longitude');

    // Kalau sudah ada koordinat sebelumnya, langsung tampilkan marker
    if (latInput.value && lngInput.value) {
        var lat = parseFloat(latInput.value);
        var lng = parseFloat(lngInput.value);
        map.setView([lat, lng], 13);
        marker = L.marker([lat, lng]).addTo(map);
    }

    // Event klik peta
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng]).addTo(map);
        }

        latInput.value = lat.toFixed(7);
        lngInput.value = lng.toFixed(7);
    });

    setTimeout(function() {
        map.invalidateSize();
    }, 0);
});
</script>
