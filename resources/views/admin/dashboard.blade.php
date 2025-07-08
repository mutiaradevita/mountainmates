@extends('layouts.dashboard')

@section('content')
{{-- Header Section --}}
<div class="bg-gradient-to-r from-pine to-moss text-white rounded-xl p-6 mb-8 shadow">
    <h1 class="text-2xl font-semibold leading-snug mb-2">Halo Admin, {{ Auth::user()->name }}</h1>
    <p class="text-sm text-mist">Kelola pengguna, trip, dan transaksi dengan mudah.</p>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    {{-- Total Pengguna --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Total Pengguna</p>
            <div class="bg-pine/10 text-pine p-2 rounded-full">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $totalUser }}</h2>
            <a href="{{ route('admin.user.index') }}" class="text-sm text-pine font-semibold hover:underline">Kelola Pengguna</a>
            <p class="text-xs text-gray-400 mt-1">Peserta & Pengelola</p>
        </div>
    </div>

    {{-- Jumlah Peserta --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Jumlah Peserta</p>
            <div class="bg-teal-100 text-teal-600 p-2 rounded-full">
                <i class="fas fa-user-friends"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $jumlahPeserta }}</h2>
            <a href="{{ route('admin.user.index', ['role' => 'peserta']) }}" class="text-sm text-pine font-semibold hover:underline">Lihat Peserta</a>
            <p class="text-xs text-gray-400 mt-1">User role peserta</p>
        </div>
    </div>

    {{-- Jumlah Pengelola --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Jumlah Pengelola</p>
            <div class="bg-indigo-100 text-indigo-600 p-2 rounded-full">
                <i class="fas fa-user-cog"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $jumlahPengelola }}</h2>
            <a href="{{ route('admin.user.index', ['role' => 'pengelola']) }}" class="text-sm text-pine font-semibold hover:underline">Lihat Pengelola</a>
            <p class="text-xs text-gray-400 mt-1">User role pengelola</p>
        </div>
    </div>

    {{-- Total Trip --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Total Trip</p>
            <div class="bg-sky/10 text-sky p-2 rounded-full">
                <i class="fas fa-map-signs"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $totalTrip }}</h2>
            <a href="{{ route('admin.trip.index') }}" class="text-sm text-pine font-semibold hover:underline">Lihat Semua Trip</a>
            <p class="text-xs text-gray-400 mt-1">Open trip aktif</p>
        </div>
    </div>

    {{-- Transaksi Menunggu --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Transaksi Menunggu</p>
            <div class="bg-sunset/10 text-sunset p-2 rounded-full">
                <i class="fas fa-hourglass-half"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $orderPending }}</h2>
            <a href="{{ route('admin.transaksi.index', ['status_pembayaran' => 'dp']) }}" class="text-sm text-pine font-semibold hover:underline">Lihat Transaksi</a>
            <p class="text-xs text-gray-400 mt-1">Belum diproses</p>
        </div>
    </div>

    {{-- Transaksi Selesai --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Transaksi Selesai</p>
            <div class="bg-forest/10 text-forest p-2 rounded-full">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $orderSelesai }}</h2>
            <a href="{{ route('admin.transaksi.index', ['status_pembayaran' => 'lunas']) }}" class="text-sm text-pine font-semibold hover:underline">Lihat Transaksi</a>
            <p class="text-xs text-gray-400 mt-1">Telah dibayar & selesai</p>
        </div>
    </div>
</div>

{{-- Trip Populer --}}
<div class="bg-white rounded-lg shadow-sm p-6 mb-8">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Trip Terpopuler</h3>
    @if($topTrips->count())
        <ul class="divide-y divide-gray-200">
            @foreach ($topTrips as $trip)
                <li class="py-3 flex justify-between items-center">
                    <span class="text-sm text-gray-700">{{ $trip->nama_trip }}</span>
                    <span class="text-sm font-medium text-moss">{{ $trip->jumlah_peserta }} peserta</span>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-sm text-gray-500">Belum ada trip dengan pendaftar.</p>
    @endif
</div>
@endsection
