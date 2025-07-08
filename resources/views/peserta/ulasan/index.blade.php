@extends('layouts.app')

@section('content')
<div class="bg-snow min-h-[calc(100vh-100px)] py-8 px-4">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-pine text-center mb-10">📋 Ulasan Saya</h1>

        @if ($ulasans->isEmpty())
            <div class="text-center text-gray-600 py-10 bg-white rounded-xl shadow">
                <p class="text-lg">Kamu belum memberikan ulasan untuk trip manapun 😌</p>
                <a href="{{ route('jelajah') }}" class="inline-block mt-4 px-4 py-2 bg-pine text-white rounded-md hover:bg-forest transition">
                    Jelajahi Trip Sekarang
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($ulasans as $ulasan)
                    <div class="bg-white border border-gray-200 p-6 rounded-xl shadow hover:shadow-md transition duration-300">
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-xl font-semibold text-forest">{{ $ulasan->trip->nama_trip ?? 'Trip Dihapus' }}</h2>
                            <div class="flex items-center gap-1 text-yellow-400 text-lg">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $ulasan->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                @endfor
                            </div>
                        </div>

                        <p class="text-gray-700 italic mb-3">"{{ $ulasan->komentar }}"</p>

                        <div class="text-sm text-gray-500 flex justify-between">
                            <span>Diulas pada {{ $ulasan->created_at->translatedFormat('d M Y') }}</span>
                            <span>Untuk trip oleh 
                                <span class="text-moss font-medium">
                                    {{ $ulasan->trip->pengelola->name ?? 'Mountain Mates' }}
                                </span>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
