@extends('layouts.dashboard')

@section('content')
<div class="pt-6 pb-10">
    <h1 class="text-center text-3xl font-bold mb-6">Tambah Trip</h1>
    <form action="{{ route('pengelola.trips.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Trip --}}
            <div class="mb-4">
                <label for="nama_trip" class="block text-gray-700">Nama Trip</label>
                <input type="text" id="nama_trip" name="nama_trip" spellcheck="false" class="form-input w-full px-4 py-2 border rounded-md" required value="{{ old('nama_trip') }}">
            </div>

            {{-- Kuota --}}
            <div class="mb-4">
                <label for="kuota" class="block text-gray-700">Kuota Peserta</label>
                <input type="number" id="kuota" name="kuota" class="form-input w-full px-4 py-2 border rounded-md" required value="{{ old('kuota') }}">
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4 md:col-span-2">
                <label for="deskripsi_trip" class="block text-gray-700">Deskripsi Trip</label>
                <textarea id="deskripsi_trip" name="deskripsi_trip" class="form-input w-full px-4 py-2 border rounded-md" required>{{ old('deskripsi_trip') }}</textarea>
            </div>

            {{-- Lokasi Gunung (daerah pendakian) --}}
            <div class="mb-4">
                <label for="lokasi" class="block text-gray-700">Lokasi Pendakian</label>
                <input type="text" id="lokasi" name="lokasi" class="form-input w-full px-4 py-2 border rounded-md placeholder-gray-200" value="{{ old('lokasi') }}" placeholder="Contoh: Malang">
            </div>

            {{-- Meeting Point --}}
            <div class="mb-4">
                <label for="meeting_point" class="block text-gray-700">Meeting Point</label>
                <input type="text" id="meeting_point" name="meeting_point" class="form-input w-full px-4 py-2 border rounded-md placeholder-gray-200" value="{{ old('meeting_point') }}" placeholder="Contoh: Basecamp Ranupani">
            </div>

            {{-- Harga --}}
            <div class="mb-4">
                <label for="harga" class="block text-gray-700">Harga</label>
                <input type="number" id="harga" name="harga" class="form-input w-full px-4 py-2 border rounded-md" required value="{{ old('harga') }}">
            </div>

            <div class="mb-4">
                <label for="dp_persen" class="block text-sm font-medium text-gray-700">Persentase DP (%)</label>
                <input type="number" name="dp_persen" id="dp_persen" min="0" max="100" class="form-input w-full px-4 py-2 border rounded-md" value="{{ old('dp_persen', 30) }}">
            </div>

            {{-- Waktu Mulai --}}
            <div class="mb-4">
                <label for="waktu" class="block text-gray-700">Waktu Mulai</label>
                <input type="time" id="waktu" name="waktu" class="form-input w-full px-4 py-2 border rounded-md" value="{{ old('waktu', '00:00') }}" required>
            </div>

            {{-- Durasi --}}
            <div class="mb-4">
                <label for="durasi" class="block text-gray-700">Durasi</label>
                <input type="text" id="durasi" name="durasi" class="form-input w-full px-4 py-2 border rounded-md placeholder-gray-200" value="{{ old('durasi') }}" placeholder="Contoh: 2 Hari 1 Malam">
            </div>

            {{-- Paket Tersedia --}}
            <div class="mb-4">
                <label for="paket" class="block text-gray-700">Paket Tersedia <small>(pisahkan dengan koma: regular,vip)</small></label>
                <input type="text" id="paket" name="paket" value="{{ old('paket', $trip->paket ?? '') }}" class="form-input w-full px-4 py-2 border rounded-md">
            </div>

            {{-- Sudah Termasuk --}}
            <div class="mb-4 md:col-span-2">
                <label for="sudah_termasuk" class="block text-gray-700">Sudah Termasuk <small>(pisahkan dengan baris baru)</small></label>
                <textarea id="sudah_termasuk" name="sudah_termasuk" class="form-input w-full px-4 py-2 border rounded-md" rows="4">{{ old('sudah_termasuk') }}</textarea>
            </div>

            {{-- Belum Termasuk --}}
            <div class="mb-4 md:col-span-2">
                <label for="belum_termasuk" class="block text-gray-700">Belum Termasuk <small>(pisahkan dengan baris baru)</small></label>
                <textarea id="belum_termasuk" name="belum_termasuk" class="form-input w-full px-4 py-2 border rounded-md" rows="4">{{ old('belum_termasuk') }}</textarea>
            </div>

            {{-- Jadwal Trip --}}
            <div class="mb-4 md:col-span-2">
                <label class="block text-gray-700 mb-2">Jadwal Trip Tersedia</label>
                <div class="flex items-center gap-4 mb-2">
                    <input type="date" name="tanggal_mulai" class="form-input px-2 py-1 border rounded w-full" required value="{{ old('tanggal_mulai') }}">
                    <span class="text-gray-500">s/d</span>
                    <input type="date" name="tanggal_selesai" class="form-input px-2 py-1 border rounded w-full" required value="{{ old('tanggal_selesai') }}">
                </div>
            </div>

            {{-- Itinerary --}}
            <div class="mb-4 md:col-span-2">
                <label for="itinerary" class="block text-gray-700">Itinerary</label>
                <textarea id="itinerary" name="itinerary" class="form-input w-full px-4 py-2 border rounded-md" rows="5" required>{{ old('itinerary') }}</textarea>
            </div>

            {{-- Flyer --}}
            <div class="mb-4">
                <label for="flyer" class="block text-gray-700">Foto Trip</label>
                <input type="file" id="flyer" name="flyer" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status Trip</label>
                <select name="status" id="status" class="form-input w-full px-4 py-2 border rounded-md" required>
                    <option value="" disabled {{ old('status') == '' ? 'selected' : '' }}>-- Pilih Status --</option>
                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
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
                Simpan Trip
            </button>
        </div>
    </form>
</div>
@endsection
