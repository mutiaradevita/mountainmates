@extends('layouts.app')

@section('title', 'Detail Trip')

@section('content')
<h1 class="text-2xl font-bold mb-6">Detail Trip</h1>

<div class="bg-white p-6 rounded shadow space-y-4">
  <p><strong>Nama Trip:</strong> {{ $trip->nama_trip }}</p>
  <p><strong>Pengelola:</strong> {{ $trip->user->name ?? '-' }}</p>
  <p><strong>Tanggal:</strong> {{ $trip->tanggal_trip }}</p>
  <p><strong>Deskripsi:</strong> {{ $trip->deskripsi }}</p>
</div>
@endsection
