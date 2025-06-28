@extends('layouts.dashboard')

@section('title', 'Peserta Trip')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-pine">Peserta untuk Trip: {{ $trip->nama_trip }}</h1>
    <p class="text-sm text-stone">Daftar peserta yang sudah mendaftar.</p>
</div>

@if ($pesertas->isEmpty())
    <p class="text-gray-500">Belum ada peserta untuk trip ini.</p>
@else
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-mist text-gray-600">
                <tr>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">No HP</th>
                    <th class="px-4 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @foreach ($pesertas as $peserta)
                    <tr>
                        <td class="px-4 py-2">{{ $peserta->user->name }}</td>
                        <td class="px-4 py-2">{{ $peserta->user->email }}</td>
                        <td class="px-4 py-2">{{ $peserta->user->nomor_telepon }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs {{ $peserta->status == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($peserta->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
