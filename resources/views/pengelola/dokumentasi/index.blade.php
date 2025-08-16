@extends('layouts.dashboard')

@section('content')
<h1 class="text-center text-2xl font-bold mb-6">Dokumentasi Trip</h1>

<a href="{{ route('pengelola.dokumentasi.create') }}" class="bg-pine text-snow px-4 py-2 rounded hover:bg-forest mb-6 inline-block">+ Tambah Dokumentasi</a>

@if (session('success'))
    <div class="text-green-600 mb-4">{{ session('success') }}</div>
@endif

<div class="overflow-x-auto bg-white shadow rounded">
    <table class="w-full table-auto border border-gray-300">
        <thead class="bg-mist text-left text-sm text-gray-700">
            <tr>
                <th class="text-center border border-gray-300 p-3">No</th>
                <th class="text-center border border-gray-300 p-3">Trip</th>
                <th class="text-center border border-gray-300 p-3">Foto</th>
                <th class="text-center border border-gray-300 p-3">Keterangan</th>
                <th class="text-center border border-gray-300 p-3">Tanggal Upload</th>
                <th class="text-center border border-gray-300 p-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm text-gray-800">
            @forelse ($dokumentasi as $index => $doc)
                <tr class="hover:bg-gray-50">
                    <td class="text-center border border-gray-300 p-3 align-top">{{ $index + 1 }}</td>
                    <td class="text-center border border-gray-300 p-3 align-top">{{ $doc->trip->nama_trip ?? '-' }}</td>
                    <td class="text-center border border-gray-300 p-3 align-top">
                        <img src="{{ asset('storage/' . $doc->foto) }}" alt="Foto Dokumentasi" class="w-20 h-auto rounded">
                    </td>
                    <td class="text-center border border-gray-300 p-3 align-top">{{ $doc->keterangan ?? '-' }}</td>
                    <td class="text-center border border-gray-300 p-3 align-top">{{ $doc->created_at->format('d M Y') }}</td>
                    <td class="border border-gray-300 p-3 align-top whitespace-nowrap">
                        <div class="flex gap-2">
                            <form action="{{ route('pengelola.dokumentasi.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Hapus dokumentasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-gray-500">
                        Belum ada dokumentasi trip.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
