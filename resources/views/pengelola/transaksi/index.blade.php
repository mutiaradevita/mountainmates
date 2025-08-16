@extends('layouts.dashboard')

@section('content')
<div x-data="{ showDetail: false, selectedId: null }">
     <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
        <h1 class="text-2xl font-bold mb-6">Daftar Transaksi Trip Anda</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($transaksis->isEmpty())
            <p class="text-gray-600">Belum ada transaksi untuk trip Anda.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border rounded shadow">
                    <thead class="bg-pine text-white">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Nama Pemesan</th>
                            <th class="px-4 py-2">Nama Trip</th>
                            <th class="px-4 py-2">Jumlah Peserta</th>
                            <th class="px-4 py-2">Total</th>
                            <th class="px-4 py-2">Status Trip</th>
                            <th class="px-4 py-2">Status Pembayaran</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksis as $index => $transaksi)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $transaksi->nama }}</td>
                            <td class="px-4 py-2">{{ $transaksi->trip->nama_trip ?? '-' }}</td>
                            <td class="text-center px-4 py-2">{{ $transaksi->jumlah_peserta }} org</td>
                            <td class="px-4 py-2">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                            <td class="text-center px-4 py-2 capitalize">
                                @php
                                    $status = $transaksi->status ?? '-';
                                    $warna = match($status) {
                                        'menunggu' => 'bg-yellow-100 text-yellow-700',
                                        'selesai' => 'bg-green-100 text-green-700',
                                        'berlangsung' => 'bg-blue-100 text-blue-700',
                                        'batal' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp
                                <span class="inline-block px-2 py-1 rounded {{ $warna }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="text-center px-4 py-2 capitalize">
                                @php
                                    $status_pembayaran = $transaksi->status_pembayaran ?? '-';
                                    $warna = match($status_pembayaran) {
                                        'dp' => 'bg-yellow-100 text-yellow-700',
                                        'lunas' => 'bg-green-100 text-green-700',
                                        'batal' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp
                                <span class="inline-block px-2 py-1 rounded {{ $warna }}">
                                    {{ $status_pembayaran }}
                                </span>
                            </td>
                            <td class="px-4 py-2 space-y-1">
                                <button 
                                    @click="selectedId = {{ $transaksi->id }}; showDetail = true"
                                    class="bg-lake text-white px-3 py-1 rounded-lg hover:bg-sky transition w-full"
                                >
                                    Detail
                                </button>

                                @if(in_array($transaksi->status_pembayaran, ['dp', 'lunas']))
                                    <a 
                                        href="{{ route('pengelola.transaksi.invoice', $transaksi->id) }}" 
                                        target="_blank"
                                        class="bg-forest text-white px-3 py-1 rounded-lg hover:bg-pine transition w-full inline-block text-center"
                                    >
                                        Invoice
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-between items-center mt-4">
                    <div>
                        <p class="text-sm text-gray-700 font-semibold">
                            Total Pemasukan: 
                            <span class="text-green-700">
                                Rp {{ number_format($transaksis->whereIn('status_pembayaran', ['dp', 'lunas'])->sum('total'), 0, ',', '.') }}
                            </span>
                        </p>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('pengelola.transaksi.laporan') }}" target="_blank"
                            class="bg-pine text-white px-3 py-1 rounded hover:bg-rose-800 transition text-sm">
                            Export PDF
                        </a>
                        <a href="{{ route('pengelola.transaksi.export.excel') }}" 
                            class="bg-forest text-white px-3 py-1 rounded hover:bg-emerald-700 transition text-sm">
                            Export Excel
                        </a>
                    </div>
                </div>
            </div>

            {{-- Modal Detail --}}
            <div 
                x-show="showDetail" 
                x-cloak 
                x-transition.opacity 
                class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center"
            >
                <div 
                    @click.away="showDetail = false" 
                    class="bg-white rounded-lg shadow-xl w-full max-w-md p-6"
                >
                    <h2 class="text-lg font-bold text-pine mb-4">🧾 Detail Transaksi</h2>

                    @foreach ($transaksis as $transaksi)
                        <div x-show="selectedId === {{ $transaksi->id }}">
                            <div class="space-y-2 text-sm text-gray-700 leading-6">
                                <p><strong>Nama:</strong> {{ $transaksi->nama }}</p>
                                <p><strong>Email:</strong> {{ $transaksi->email }}</p>
                                <p><strong>No HP:</strong> {{ $transaksi->nomor_telepon }}</p>
                                <p><strong>Nama Trip:</strong> {{ $transaksi->trip->nama_trip ?? '-' }}</p>
                                <p><strong>Jumlah Peserta:</strong> {{ $transaksi->jumlah_peserta }}</p>
                                <p><strong>Total:</strong> Rp {{ number_format($transaksi->total, 0, ',', '.') }}</p>
                                <p><strong>Status Trip:</strong> {{ ucfirst($transaksi->status) }}</p>
                                <p><strong>Status Pembayaran:</strong> {{ ucfirst($transaksi->status_pembayaran ?? '-') }}</p>
                                <p><strong>Order ID:</strong> {{ $transaksi->payment_order_id ?? '-' }}</p>
                            </div>

                            <div class="mt-6 text-right">
                                <button 
                                    @click="showDetail = false" 
                                    class="bg-pine text-white px-4 py-2 rounded hover:bg-forest transition"
                                >
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
