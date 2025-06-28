@extends('layouts.dashboard')

@section('title', 'Detail Transaksi')

@section('content')
<h1 class="text-2xl font-bold mb-6">Detail Transaksi</h1>

<div class="bg-white p-6 rounded shadow space-y-4">
  <p><strong>Nama Peserta:</strong> {{ $transaksi->user->name ?? '-' }}</p>
  <p><strong>Nama Trip:</strong> {{ $transaksi->trip->nama_trip ?? '-' }}</p>
  <p><strong>Status:</strong> {{ ucfirst($transaksi->status) }}</p>
  <p><strong>Tanggal Booking:</strong> {{ $transaksi->created_at->format('d M Y') }}</p>
</div>
@endsection
