@extends('layouts.dashboard')

@section('content')
<div class="bg-white p-6 rounded shadow mb-6">
    <h2 class="text-center text-lg font-semibold text-gray-800 mb-4">Semua Aktivitas</h2>
    <ul class="divide-y divide-gray-200">
        @forelse($aktivitas as $item)
            <li class="py-3 flex justify-between items-start">
                <span class="text-sm text-gray-700">{{ $item['pesan'] }}</span>
                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item['waktu'])->diffForHumans() }}</span>
            </li>
        @empty
            <li class="py-3 text-gray-500 text-sm">Belum ada aktivitas tercatat.</li>
        @endforelse
    </ul>
</div>
@endsection
