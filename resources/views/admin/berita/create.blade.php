@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="judul" class="w-full mt-1 border-gray-300 rounded shadow-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Sumber</label>
            <input type="text" name="sumber" class="w-full mt-1 border-gray-300 rounded shadow-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">URL Asli</label>
            <input type="url" name="url" class="w-full mt-1 border-gray-300 rounded shadow-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Deskripsi Singkat (opsional)</label>
            <textarea name="deskripsi" rows="4" class="w-full mt-1 border-gray-300 rounded shadow-sm"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Gambar (opsional)</label>
            <input type="file" name="gambar" class="mt-1">
        </div>

        <div class="text-right">
            <button type="submit" class="bg-pine text-white px-4 py-2 rounded hover:bg-forest">
                Simpan Berita
            </button>
        </div>
    </form>
</div>
@endsection
