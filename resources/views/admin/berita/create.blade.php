@extends('layouts.dashboard')

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
            <label class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
            <textarea name="deskripsi" rows="4" class="w-full mt-1 border-gray-300 rounded shadow-sm" required></textarea>
            @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
        <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>

        <div class="mt-2 flex items-center gap-3">
            <label for="gambar" class="cursor-pointer bg-forest hover:bg-pine text-white px-4 py-2 rounded-md text-sm">
            📎 Pilih Gambar
            </label>
            <span id="file-name" class="text-sm text-gray-600">Belum ada file</span>
        </div>

        <input id="gambar" name="gambar" type="file" class="hidden" onchange="updateFileName(this)">
        @error('gambar') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <script>
        function updateFileName(input) {
            const fileName = input.files[0] ? input.files[0].name : 'Belum ada file';
            document.getElementById('file-name').textContent = fileName;
        }
        </script>

        <div class="text-right">
            <button type="submit" class="bg-pine text-white px-4 py-2 rounded hover:bg-forest">
                Simpan Berita
            </button>
        </div>
    </form>
</div>
@endsection
