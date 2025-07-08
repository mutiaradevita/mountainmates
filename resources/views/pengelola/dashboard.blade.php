@extends('layouts.dashboard')

@section('content')
{{-- Header --}}
<div class="bg-gradient-to-r from-pine to-moss text-white rounded-xl p-6 mb-8 shadow">
    <h1 class="text-2xl font-semibold leading-snug mb-2">Halo Pengelola, {{ Auth::user()->name }}</h1>
    <p class="text-sm text-mist">Pantau aktivitas trip dan peserta secara real-time di sini.</p>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    {{-- Total Trip Dibuat --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Total Trip Dibuat</p>
            <div class="bg-pine/10 text-pine p-2 rounded-full">
                <i class="fas fa-folder-open"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $totalTripSaya ?? 0 }}</h2>
            <a href="{{ route('pengelola.trips.index') }}" class="text-sm text-pine font-semibold hover:underline">
                Kelola Semua Trip
            </a>
            <p class="text-xs text-gray-400 mt-1">Semua trip yang kamu buat</p>
        </div>
    </div>

    {{-- Trip Berlangsung --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Trip Berlangsung</p>
            <div class="bg-blue-100 text-blue-600 p-2 rounded-full">
                <i class="fas fa-play-circle"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $tripBerlangsung ?? 0 }}</h2>
            <a href="{{ route('pengelola.trips.index', ['status' => 'aktif']) }}" class="text-sm text-pine font-semibold hover:underline">
                Lihat Trip Aktif
            </a>
            <p class="text-xs text-gray-400 mt-1">Trip yang sedang berjalan</p>
        </div>
    </div>

    {{-- Trip Akan Datang --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Trip Akan Datang</p>
            <div class="bg-yellow-100 text-yellow-600 p-2 rounded-full">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $tripAkanDatang ?? 0 }}</h2>
            <a href="{{ route('pengelola.trips.index', ['status' => 'aktif']) }}" class="text-sm text-pine font-semibold hover:underline">
                Jadwal Trip Mendatang
            </a>
            <p class="text-xs text-gray-400 mt-1">Trip yang belum dimulai</p>
        </div>
    </div>

    {{-- Trip Selesai --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Trip Selesai</p>
            <div class="bg-green-100 text-green-600 p-2 rounded-full">
                <i class="fas fa-flag-checkered"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $tripSelesai ?? 0 }}</h2>
            <a href="{{ route('pengelola.trips.history') }}" class="text-sm text-pine font-semibold hover:underline">
                Riwayat Trip
            </a>
            <p class="text-xs text-gray-400 mt-1">Trip yang telah berakhir</p>
        </div>
    </div>

    {{-- Pendaftaran Dibatalkan --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Pendaftaran Dibatalkan</p>
            <div class="bg-red-100 text-red-600 p-2 rounded-full">
                <i class="fas fa-user-slash"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $pesertaBatal ?? 0 }}</h2>
            <a href="{{ route('pengelola.transaksi.index', ['status' => 'batal']) }}"
            class="text-sm text-pine font-semibold hover:underline">
                Lihat Daftar Batal
            </a>
            <p class="text-xs text-gray-400 mt-1">Peserta yang membatalkan keikutsertaan</p>
        </div>
    </div>

    {{-- Total Peserta --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Total Peserta</p>
            <div class="bg-forest/10 text-forest p-2 rounded-full">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $totalPeserta ?? 0 }}</h2>
            <a href="{{ route('pengelola.trips.index') }}" class="text-sm text-pine font-semibold hover:underline">
                Lihat Trip & Peserta
            </a>
            <p class="text-xs text-gray-400 mt-1">Peserta dari semua trip</p>
        </div>
    </div>

    {{-- Peserta Belum Lunas --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Peserta Belum Lunas</p>
            <div class="bg-orange-100 text-orange-600 p-2 rounded-full">
                <i class="fas fa-exclamation-circle"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $pesertaBelumLunas ?? 0 }}</h2>
            <a href="{{ route('pengelola.transaksi.index', ['status' => 'belum_lunas']) }}" class="text-sm text-pine font-semibold hover:underline">
                Cek Pembayaran
            </a>
            <p class="text-xs text-gray-400 mt-1">Peserta yang masih DP</p>
        </div>
    </div>

    {{-- Transaksi Lunas --}}
    <div class="bg-white rounded-lg shadow-sm p-5 flex flex-col justify-between h-full">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Transaksi Lunas</p>
            <div class="bg-emerald-100 text-emerald-600 p-2 rounded-full">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ $transaksiLunas ?? 0 }}</h2>
            <a href="{{ route('pengelola.transaksi.index', ['status' => 'lunas']) }}" class="text-sm text-pine font-semibold hover:underline">
                Riwayat Pembayaran
            </a>
            <p class="text-xs text-gray-400 mt-1">Peserta yang sudah melunasi</p>
        </div>
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
