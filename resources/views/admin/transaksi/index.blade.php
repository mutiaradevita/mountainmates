@extends('layouts.dashboard')

@section('title', 'Data Transaksi')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Transaksi</h1>

<table class="w-full table-auto text-sm bg-white shadow rounded">
  <thead class="bg-gray-100">
    <tr>
      <th class="px-4 py-2">Peserta</th>
      <th class="px-4 py-2">Trip</th>
      <th class="px-4 py-2">Status</th>
      <th class="px-4 py-2">Tanggal</th>
      <th class="px-4 py-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($transaksi as $item)
    <tr class="border-t">
      <td class="px-4 py-2">{{ $item->user->name ?? '-' }}</td>
      <td class="px-4 py-2">{{ $item->trip->nama_trip ?? '-' }}</td>
      <td class="px-4 py-2 capitalize">{{ $item->status }}</td>
      <td class="px-4 py-2">{{ $item->created_at->format('d M Y') }}</td>
      <td class="px-4 py-2">
        <a href="{{ route('admin.transaksi.show', $item->id) }}" class="text-blue-600">Detail</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
