@extends('layouts.dashboard')

@section('content')
 <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
    <h1 class="text-2xl font-bold text-pine">Peserta untuk Trip: {{ $trip->nama_trip }}</h1>
</div>

@if ($pesertas->isEmpty())
    <p class="text-gray-500">Belum ada peserta untuk trip ini.</p>
@else
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-mist text-gray-600">
                <tr>
                    <th class="text-center px-4 py-3">Pemesan</th>
                    <th class="text-center px-4 py-3">Email</th>
                    <th class="text-center px-4 py-3">Nomor Telepon</th>
                    <th class="text-center px-4 py-3">Jumlah Peserta</th>
                    <th class="text-center px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @foreach ($pesertas as $peserta)
                    <tr>
                        <td class="text-center px-4 py-2">{{ $peserta->user->name }}</td>
                        <td class="text-center px-4 py-2">{{ $peserta->user->email }}</td>
                        <td class="text-center px-4 py-2">{{ $peserta->nomor_telepon }}</td>
                        <td class="text-center px-4 py-2">{{ $peserta->jumlah_peserta }}</td>
                        <td class="text-center px-4 py-2">
                            <button 
                                onclick="document.getElementById('detail-{{ $peserta->id }}').classList.toggle('hidden')"
                                class="bg-pine text-white px-3 py-1 rounded hover:bg-moss text-xs transition">
                                Detail
                            </button>
                        </td>
                    </tr>

                    {{-- Detail Teman --}}
                    <tr id="detail-{{ $peserta->id }}" class="hidden bg-gray-50">
                    <td colspan="5" class="px-6 py-4">
                        <div class="font-semibold text-pine mb-2">Daftar Peserta:</div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-slate-200 text-sm rounded-md">
                                <thead class="bg-slate-100 text-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 text-left">#</th>
                                        <th class="px-4 py-2 text-left">Nama Peserta</th>
                                        <th class="px-4 py-2 text-left">Email</th>
                                        <th class="px-4 py-2 text-left">No Telepon</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800">
                                    @foreach ($peserta->peserta as $index => $teman)
                                        <tr>
                                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                                            <td class="px-4 py-2">{{ $teman->nama }}</td>
                                            <td class="px-4 py-2">{{ $teman->email ?? '—' }}</td>
                                            <td class="px-4 py-2">{{ $teman->nomor_telepon ?? '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
