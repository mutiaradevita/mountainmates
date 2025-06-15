@extends('layouts.pendaki') {{-- ganti sesuai layoutmu --}}

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Riwayat Pemesanan Trip</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @forelse($transaksis as $transaksi)
        <div class="p-4 border mb-4 rounded">
            <p><strong>Nama Trip:</strong> {{ $transaksi->trip->nama }}</p>
            <p><strong>Status:</strong> {{ $transaksi->status }}</p>
        </div>
    @empty
        <p>Kamu belum melakukan pemesanan trip.</p>
    @endforelse
</div>
@endsection
