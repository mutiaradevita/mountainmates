@extends('layouts.dashboard')

@section('title', 'Detail Berita')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-forest">{{ $berita->judul }}</h1>

    <p class="text-sm text-gray-500 mb-2">Sumber: {{ $berita->sumber }} | Dipublikasikan: {{ $berita->created_at->format('d M Y') }}</p>

    @if ($berita->gambar)
        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="mb-4 w-full max-h-[300px] object-cover rounded">
    @endif

    <p class="text-gray-700 leading-relaxed mb-6">
        {{ $berita->deskripsi }}
    </p>

    <a href="{{ $berita->url }}" target="_blank" class="inline-block bg-sunset text-white px-4 py-2 rounded hover:bg-orange-500 transition">
        Baca Selengkapnya
    </a>
</div>
@endsection
