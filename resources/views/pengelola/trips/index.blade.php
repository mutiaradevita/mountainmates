@extends('layouts.app')

@section('title', 'Edit Trip')

@section('content')
    <div class="mb-6">
        <a href="{{ route('pengelola.trips.create') }}"
           class="bg-forest text-white px-4 py-2 rounded-xl hover:bg-pine transition">
            + Tambah Trip
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-xl">
            <thead class="bg-moss text-white">
                <tr>
                    <th class="text-pine text-left px-6 py-3">Nama</th>
                    <th class="text-pine text-left px-6 py-3">Lokasi</th>
                    <th class="text-pine text-left px-6 py-3">Periode</th>
                    <th class="text-pine text-left px-6 py-3">Harga</th>
                    <th class="text-pine text-left px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trips as $trip)
                    <tr class="border-t hover:bg-mist">
                        <td class="px-6 py-4">{{ $trip->nama_trip }}</td>
                        <td class="px-6 py-4">{{ $trip->lokasi }}</td>
                        <td class="px-6 py-4">{{ $trip->tanggal_mulai }} - {{ $trip->tanggal_selesai }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($trip->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('pengelola.trips.show', $trip->id) }}"
                               class="bg-lake text-white px-3 py-1 rounded-lg hover:bg-sky transition">
                                Detail
                            </a>
                            <a href="{{ route('pengelola.trips.edit', $trip->id) }}"
                               class="bg-sunset text-white px-3 py-1 rounded-lg hover:bg-orange-400 transition">
                                Edit
                            </a>
                            <a href="{{ route('pengelola.trips.peserta', $trip->id) }}"
                                class="bg-emerald-600 text-white px-3 py-1 rounded-lg hover:bg-emerald-700 transition">
                                Peserta
                            </a>
                            <form action="{{ route('pengelola.trips.destroy', $trip->id) }}"
                                  method="POST" onsubmit="return confirm('Yakin ingin hapus trip ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-stone-500">Belum ada trip yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
