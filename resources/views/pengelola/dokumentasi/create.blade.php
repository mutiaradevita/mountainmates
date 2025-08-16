@extends('layouts.dashboard')

@section('content')
<div class="bg-snow min-h-[calc(100vh-100px)] py-8 px-4">
    <h2 class="text-2xl font-bold mb-4">Tambah Dokumentasi Trip</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pengelola.dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-2">Pilih Trip</label>
            <select name="id_trip" class="w-full border rounded p-2">
                <option value="">-- Pilih Trip --</option>
                @foreach($trips as $trip)
                    <option value="{{ $trip->id }}">{{ $trip->nama_trip }}</option>
                @endforeach
            </select>
            @error('id_trip') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Foto Dokumentasi</label>
            <input type="file" name="foto" class="w-full border rounded p-2">
            @error('foto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Keterangan (opsional)</label>
            <textarea name="keterangan" class="w-full border rounded p-2" rows="4"></textarea>
        </div>

        <button type="submit" class="bg-pine hover:bg-forest text-snow px-4 py-2 rounded">
            Simpan Dokumentasi
        </button>
    </form>
</div>
@endsection
