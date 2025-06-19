@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-semibold mb-4 text-forest">Edit Berita</h1>

    <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Sumber</label>
            <input type="text" name="sumber" value="{{ old('sumber', $berita->sumber) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">URL Asli</label>
            <input type="url" name="url" value="{{ old('url', $berita->url) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="w-full border rounded px-3 py-2">{{ old('deskripsi', $berita->deskripsi) }}</textarea>
        </div>

        @if ($berita->gambar)
            <div class="mb-4">
                <label class="block font-semibold">Gambar Saat Ini:</label>
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="w-40 h-auto mt-2 rounded">
            </div>
        @endif

        <div class="mb-4">
            <label class="block font-semibold">Ganti Gambar (Opsional)</label>
            <input type="file" name="gambar" accept="image/*" class="w-full">
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.berita.index') }}" class="text-gray-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-pine text-white px-4 py-2 rounded hover:bg-forest transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
