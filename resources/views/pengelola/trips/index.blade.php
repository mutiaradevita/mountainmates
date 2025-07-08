@extends('layouts.dashboard')

@section('content')
 <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
    {{-- Tombol Tambah Trip (kiri) --}}
    <a href="{{ route('pengelola.trips.create') }}"
       class="bg-forest text-white px-4 py-2 rounded-xl hover:bg-pine transition">
        + Tambah Trip
    </a>

    {{-- Filter Status (kanan) --}}
    <form method="GET" action="{{ route('pengelola.trips.index') }}" class="flex items-center gap-2">
        <label for="status" class="text-sm text-gray-700">Status:</label>
        <select name="status" id="status" onchange="this.form.submit()"
                class="px-3 py-2 border rounded-md text-sm">
            <option value="">Semua</option>
            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </form>
</div>


    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-xl">
            <thead class="bg-mist text-white">
                <tr>
                    <th class="text-pine text-center px-6 py-3">Nama</th>
                    <th class="text-pine text-center px-6 py-3">Lokasi</th>
                    <th class="text-pine text-center px-6 py-3">Tanggal Mulai</th>
                    <th class="text-pine text-center px-6 py-3">Tanggal Selesai</th>
                    <th class="text-pine text-center px-6 py-3">Waktu</th>
                    <th class="text-pine text-center px-6 py-3">Status</th>
                    <th class="text-pine text-center px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trips as $trip)
                    <tr class="border-t hover:bg-snow">
                        <td class="px-6 py-4">{{ $trip->nama_trip }}</td>
                        <td class="px-6 py-4">{{ $trip->lokasi }}</td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($trip->tanggal_mulai)->translatedFormat('l, d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($trip->tanggal_selesai)->translatedFormat('l, d M Y') }}
                        </td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($trip->waktu)->format('H:i') }}</td>
                        <td class="px-6 py-4 capitalize">{{ $trip->status }}</td>
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



