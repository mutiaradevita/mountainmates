@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Trip</h1>

<table class="w-full table-auto text-sm bg-white shadow rounded">
  <thead class="bg-mist">
    <tr>
      <th class="text-center px-4 py-2">Nama Trip</th>
      <th class="text-center px-4 py-2">Pengelola</th>
      <th class="text-center px-4 py-2">Tanggal Mulai</th>
      <th class="text-center px-4 py-2">Tanggal Selesai</th>
      <th class="text-pine text-center px-6 py-3">Kuota Terisi / Kuota Tersedia</th>
      <th class="text-center px-4 py-2">Status Trip</th>
      <th class="text-center px-4 py-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($trips as $trip)
    <tr class="border-t">
      <td class="text-center px-4 py-2">{{ $trip->nama_trip }}</td>
      <td class="text-center px-4 py-2">{{ $trip->pengelola_name ?? '-' }}</td>
      <td class="text-center px-4 py-2">{{ \Carbon\Carbon::parse($trip->tanggal_mulai)->translatedFormat('l, d M Y') }}</td>
      <td class="text-center px-4 py-2">{{ \Carbon\Carbon::parse($trip->tanggal_selesai)->translatedFormat('l, d M Y') }}</td>
      <td class="px-6 py-4 text-center">{{ $trip->transaksi()->where('status', '!=', 'batal')->sum('jumlah_peserta') }} / {{ $trip->kuota }}</td>
      <td class="text-center px-4 py-2 capitalize">{{ $trip->status }}</td>
      <td class="px-6 py-4 flex space-x-2">
        <a href="{{ route('admin.trip.show', $trip->id) }}" class="bg-lake text-white px-3 py-1 rounded-lg hover:bg-sky transition">Detail</a>
          <form action="{{ route('pengelola.trips.destroy', $trip->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus trip ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition"> Hapus </button>
          </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
