@extends('layouts.dashboard')

@section('title', 'Dashboard Pengelola')

@section('content')
{{-- Header --}}
<div class="bg-gradient-to-r from-pine to-moss text-white rounded-xl p-6 mb-8 shadow">
    <h1 class="text-2xl font-semibold leading-snug mb-2">Halo Pengelola, {{ Auth::user()->name }}</h1>
    <p class="text-sm text-mist">Pantau aktivitas trip dan peserta secara real-time di sini.</p>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    {{-- Total Trip Aktif --}}
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl p-5">
        <div class="flex items-center justify-between">
            <p class="text-sm text-stone font-medium">Total Trip Aktif</p>
            <div class="bg-pine/10 text-pine p-2 rounded-full">
                <i class="fas fa-hiking"></i>
            </div>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mt-3">{{ $totalTrip ?? '-' }}</h2>
        <p class="text-xs text-gray-400 mt-1">Trip yang masih berlangsung</p>
    </div>

    {{-- Total Peserta --}}
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl p-5">
        <div class="flex items-center justify-between">
            <p class="text-sm text-stone font-medium">Total Peserta</p>
            <div class="bg-forest/10 text-forest p-2 rounded-full">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mt-3">{{ $totalPeserta ?? '-' }}</h2>
        <p class="text-xs text-gray-400 mt-1">Peserta yang mendaftar trip</p>
    </div>

    {{-- Transaksi Selesai --}}
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl p-5">
        <div class="flex items-center justify-between">
            <p class="text-sm text-stone font-medium">Transaksi Selesai</p>
            <div class="bg-green-100 text-green-500 p-2 rounded-full">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mt-3">{{ $totalTransaksiSelesai ?? '-' }}</h2>
        <p class="text-xs text-gray-400 mt-1">Pembayaran berhasil</p>
    </div>
</div>

{{-- Daftar Ulasan --}}
<div class="bg-white border border-slate-200 shadow-sm rounded-xl p-6">
    <h2 class="text-xl font-semibold text-pine mb-4">📝 Ulasan Peserta</h2>

    @forelse ($ulasanDiterima as $ulasan)
        <div class="mb-4 border-b border-gray-100 pb-4">
            <div class="flex justify-between items-center mb-1">
                <p class="text-stone font-medium">{{ $ulasan->user->name ?? 'Peserta Tidak Dikenal' }}</p>
                <span class="text-yellow-400 text-sm">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $ulasan->rating ? '' : 'text-gray-300' }}"></i>
                    @endfor
                </span>
            </div>
            <p class="text-gray-700 italic">"{{ $ulasan->komentar }}"</p>
        </div>
    @empty
        <p class="text-gray-500 text-sm">Belum ada ulasan yang masuk.</p>
    @endforelse
</div>
@endsection
