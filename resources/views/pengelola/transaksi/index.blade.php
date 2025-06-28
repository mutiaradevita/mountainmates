@extends('layouts.dashboard')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Daftar Transaksi Trip Anda</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($transaksis->isEmpty())
        <p class="text-gray-600">Belum ada transaksi untuk trip Anda.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded shadow">
                <thead class="bg-pine text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Nama Peserta</th>
                        <th class="px-4 py-2 text-left">Trip</th>
                        <th class="px-4 py-2 text-left">Jumlah</th>
                        <th class="px-4 py-2 text-left">Total</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $index => $transaksi)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $transaksi->nama }}</td>
                        <td class="px-4 py-2">{{ $transaksi->trip->nama_trip ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $transaksi->jumlah_peserta }} org</td>
                        <td class="px-4 py-2">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 capitalize">
                            <span class="inline-block px-2 py-1 rounded 
                                {{ $transaksi->status == 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $transaksi->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            @if($transaksi->status === 'menunggu')
                                <form action="{{ route('pengelola.transaksi.konfirmasi', $transaksi->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-pine text-white px-3 py-1 rounded hover:bg-green-700 text-sm">
                                        Konfirmasi
                                    </button>
                                </form>
                            @else
                                <span class="text-sm text-gray-500">Sudah dikonfirmasi</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
