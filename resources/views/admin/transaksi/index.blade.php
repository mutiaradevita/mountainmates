@extends('layouts.dashboard')

@section('content')
<div x-data="{ showDetail: false, selectedId: null }">
    <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
        <h1 class="text-2xl font-bold mb-6">Daftar Semua Transaksi</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($transaksi->isEmpty())
            <p class="text-gray-600">Belum ada transaksi yang tercatat.</p>
        @else
            <div class="overflow-x-auto">
                  <table class="w-full table-auto text-sm bg-white shadow rounded">
                      <thead class="bg-mist">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Pemesan</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Trip</th>
                            <th class="px-4 py-2">Pengelola</th>
                            <th class="px-4 py-2">Jumlah</th>
                            <th class="px-4 py-2">Total</th>
                            <th class="px-4 py-2">Status Trip</th>
                            <th class="px-4 py-2">Pembayaran</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi as $index => $trx)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $trx->nama }}</td>
                            <td class="px-4 py-2">{{ $trx->email }}</td>
                            <td class="px-4 py-2">{{ $trx->trip->nama_trip ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $trx->pengelola_nama  ?? '-' }}</td>
                            <td class="text-center px-4 py-2">{{ $trx->jumlah_peserta }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                            <td class="text-center px-4 py-2 capitalize">
                                @php
                                    $status = $trx->status ?? '-';
                                    $warna = match($status) {
                                        'menunggu' => 'bg-yellow-100 text-yellow-700',
                                        'selesai' => 'bg-green-100 text-green-700',
                                        'berlangsung' => 'bg-blue-100 text-blue-700',
                                        'batal' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp
                                <span class="inline-block px-2 py-1 rounded {{ $warna }}">{{ $status }}</span>
                            </td>
                            <td class="text-center px-4 py-2 capitalize">
                                @php
                                    $bayar = $trx->status_pembayaran ?? '-';
                                    $warna = match($bayar) {
                                        'dp' => 'bg-yellow-100 text-yellow-700',
                                        'lunas' => 'bg-green-100 text-green-700',
                                        'batal' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp
                                <span class="inline-block px-2 py-1 rounded {{ $warna }}">{{ $bayar }}</span>
                            </td>
                            <td class="px-4 py-2">
                                <button @click="selectedId = {{ $trx->id }}; showDetail = true"
                                        class="bg-lake text-white px-3 py-1 rounded-lg hover:bg-sky transition">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Modal Detail --}}
            <div x-show="showDetail" x-cloak x-transition.opacity class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center">
                <div @click.away="showDetail = false" class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
                    <h2 class="text-lg font-bold text-pine mb-4">🧾 Detail Transaksi</h2>

                    @foreach ($transaksi as $trx)
                        <div x-show="selectedId === {{ $trx->id }}">
                            <div class="space-y-2 text-sm text-gray-700 leading-6">
                                <p><strong>Nama:</strong> {{ $trx->nama }}</p>
                                <p><strong>Email:</strong> {{ $trx->email }}</p>
                                <p><strong>No HP:</strong> {{ $trx->nomor_telepon }}</p>
                                <p><strong>Trip:</strong> {{ $trx->trip->nama_trip ?? '-' }}</p>
                                <p><strong>Pengelola:</strong> {{ $trx->pengelola_nama  ?? '-' }}</p>
                                <p><strong>Jumlah Peserta:</strong> {{ $trx->jumlah_peserta }}</p>
                                <p><strong>Total:</strong> Rp {{ number_format($trx->total, 0, ',', '.') }}</p>
                                <p><strong>Status Trip:</strong> {{ ucfirst($trx->status) }}</p>
                                <p><strong>Status Pembayaran:</strong> {{ ucfirst($trx->status_pembayaran ?? '-') }}</p>
                                <p><strong>Order ID:</strong> {{ $trx->payment_order_id ?? '-' }}</p>
                            </div>

                            <div class="mt-6 text-right">
                                <button @click="showDetail = false"
                                        class="bg-pine text-white px-4 py-2 rounded hover:bg-forest transition">
                                    <i class="fas fa-times mr-2"></i> Tutup
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
