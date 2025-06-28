@extends('layouts.dashboard')

@section('title', 'Data Trip')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Trip</h1>

<table class="w-full table-auto text-sm bg-white shadow rounded">
  <thead class="bg-gray-100">
    <tr>
      <th class="text-center px-4 py-2">Nama Trip</th>
      <th class="text-center px-4 py-2">Pengelola</th>
      <th class="text-center px-4 py-2">Tanggal Mulai</th>
      <th class="text-center px-4 py-2">Tanggal Selesai</th>
      <th class="text-center px-4 py-2">Status</th>
      <th class="text-center px-4 py-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($trips as $trip)
    <tr class="border-t">
      <td class="px-4 py-2">{{ $trip->nama_trip }}</td>
      <td class="px-4 py-2">{{ $trip->pengelola->name ?? '-' }}</td>
      <td class="px-4 py-2">{{ $trip->tanggal_mulai }}</td>
      <td class="px-4 py-2">{{ $trip->tanggal_selesai }}</td>
      <td class="px-4 py-2">{{ $trip->status }}</td>
      <td class="px-4 py-2">
        <a href="{{ route('admin.trip.show', $trip->id) }}" class="text-center text-blue-600">Detail</a>
        <form action="{{ route('admin.trip.destroy', $trip->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus trip ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-100 text-red-700 px-3 py-1 rounded hover:bg-red-200 text-sm">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
