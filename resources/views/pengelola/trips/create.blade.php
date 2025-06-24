@extends('layouts.app')

@section('title', 'Tambah Trip')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Tambah Trip</h1>
    @if ($errors->any())
    <div class="mb-4 text-red-600">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('pengelola.trips.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Trip --}}
            <div class="mb-4">
                <label for="nama_trip" class="block text-gray-700">Nama Trip</label>
                <input type="text" id="nama_trip" name="nama_trip" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            {{-- Deskripsi Trip --}}
            <div class="mb-4">
                <label for="deskripsi_trip" class="block text-gray-700">Deskripsi</label>
                <textarea id="deskripsi_trip" name="deskripsi_trip" class="w-full px-4 py-2 border rounded-md" required></textarea>
            </div>

            <div class="mb-4 md:col-span-2">
                <label for="jadwal" class="block text-gray-700">Jadwal</label>
                <input type="text" id="jadwal_trip" name="jadwal_trip" class="w-full px-4 py-2 border rounded-md" placeholder=" " required>
            </div>

            <div class="mb-4 md:col-span-2">
                <label for="itinerary" class="block text-gray-700">Itinerary</label>
                <textarea id="itinerary" name="itinerary" class="w-full px-4 py-2 border rounded-md" rows="5" placeholder=" " required></textarea>
            </div>

            {{-- Tanggal --}}
            <div class="mb-4">
                <label for="tanggal_trip" class="block text-gray-700">Tanggal Trip</label>
                <input type="date" id="tanggal_trip" name="tanggal_trip" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="tipe_trip" class="block text-gray-700">Tipe Trip</label>
                <select id="tipe_trip" name="tipe_trip" class="w-full px-4 py-2 border rounded-md" required>
                    <option value="open">Open Trip</option>
                    <option value="private">Private Trip</option>
                </select>
            </div>

            {{-- Waktu --}}
            <div class="mb-4">
                <label for="waktu" class="block text-gray-700">Waktu Mulai</label>
                <input type="time" name="waktu" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            {{-- Lokasi --}}
            <div class="mb-4">
                <label for="lokasi" class="block text-gray-700">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            {{-- Kuota --}}
            <div class="mb-4">
                <label for="kuota" class="block text-gray-700">Kuota Peserta</label>
                <input type="number" id="kuota" name="kuota" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            {{-- Harga --}}
            <div class="mb-4">
                <label for="harga" class="block text-gray-700">Harga</label>
                <input type="number" id="harga" name="harga" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            {{-- Flyer --}}
            <div class="mb-4">
                <label for="flyer" class="block text-gray-700">Foto Trip / Flyer</label>
                <input type="file" id="flyer" name="flyer" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border rounded-md" required>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
        </div>

        <button type="submit" class="mt-6 py-2 px-6 bg-pine text-snow rounded-lg hover:bg-forest">Simpan Trip</button>
    </form>
</div>
@endsection
