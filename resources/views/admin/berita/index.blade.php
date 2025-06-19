@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <a href="{{ route('admin.berita.create') }}"
       class="bg-pine text-snow px-4 py-2 rounded hover:bg-forest mb-6 inline-block">
        + Tambah Berita
    </a>

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="w-full table-auto border border-gray-300">
            <thead class="bg-mist text-left text-sm text-gray-700">
                <tr>
                    <th class="border border-gray-300 p-3">Judul</th>
                    <th class="border border-gray-300 p-3">Sumber</th>
                    <th class="border border-gray-300 p-3">Deskripsi</th>
                    <th class="border border-gray-300 p-3">URL</th>
                    <th class="border border-gray-300 p-3">Gambar</th>
                    <th class="border border-gray-300 p-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800">
                @forelse ($beritas as $berita)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 p-3 align-top">{{ $berita->judul }}</td>
                        <td class="border border-gray-300 p-3 align-top">{{ $berita->sumber }}</td>
                        <td class="border border-gray-300 p-3 align-top">
                            {{ \Illuminate\Support\Str::limit($berita->deskripsi, 100) }}
                        </td>
                        <td class="border border-gray-300 p-3 align-top">
                            <a href="{{ $berita->url }}" target="_blank" class="text-blue-500 underline">Link</a>
                        </td>
                        <td class="border border-gray-300 p-3 align-top">
                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar" class="w-20 h-auto rounded">
                            @else
                                <span class="text-gray-500 italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 p-3 align-top whitespace-nowrap">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-4 text-gray-500">
                            Belum ada berita.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
