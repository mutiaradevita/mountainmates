@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
{{-- Header Section --}}
<div class="bg-gradient-to-r from-pine to-moss text-white rounded-xl p-6 mb-8 shadow">
    <h1 class="text-2xl font-semibold leading-snug mb-2">Halo Admin, {{ Auth::user()->name }}</h1>
    <p class="text-sm text-mist">Kelola pengguna, trip, dan transaksi dengan mudah.</p>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    {{-- Card: Total Pengguna --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Total Pengguna</p>
            <div class="bg-pine/10 text-pine p-2 rounded-full">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $totalUser }}</h2>
            <p class="text-xs text-gray-400 mt-1">Peserta & Pengelola</p>
        </div>
    </div>

    {{-- Card: Total Trip --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Total Trip</p>
            <div class="bg-sky/10 text-sky p-2 rounded-full">
                <i class="fas fa-map-signs"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $totalTrip }}</h2>
            <p class="text-xs text-gray-400 mt-1">Open trip aktif</p>
        </div>
    </div>

    {{-- Card: Transaksi Menunggu --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Transaksi Menunggu</p>
            <div class="bg-sunset/10 text-sunset p-2 rounded-full">
                <i class="fas fa-hourglass-half"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $orderPending }}</h2>
            <p class="text-xs text-gray-400 mt-1">Belum diproses</p>
        </div>
    </div>

    {{-- Card: Transaksi Selesai --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Transaksi Selesai</p>
            <div class="bg-forest/10 text-forest p-2 rounded-full">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $orderSelesai }}</h2>
            <p class="text-xs text-gray-400 mt-1">Telah dibayar & selesai</p>
        </div>
    </div>
</div>
@endsection
