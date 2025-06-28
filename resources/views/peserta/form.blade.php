@extends('layouts.app')

@section('content')
<section class="pt-[80px] pb-16 bg-snow">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

            <!-- Kolom 1: Info Trip -->
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <img src="{{ asset('storage/' . $trip->flyer) }}" alt="{{ $trip->nama_trip }}"
                    class="w-full h-64 object-cover rounded-lg mb-4">
                <h1 class="text-2xl font-bold text-pine mb-2">{{ $trip->nama_trip }}</h1>
                <p class="text-gray-700 mb-2">{{ $trip->deskripsi_trip }}</p>
                <p class="text-sm text-gray-500">Lokasi: {{ $trip->lokasi }}</p>
                <p class="text-sm text-gray-500">Tanggal Trip: {{ \Carbon\Carbon::parse($trip->tanggal_trip)->translatedFormat('d F Y') }}</p>
                <p class="text-sm text-gray-500">Waktu: {{ \Carbon\Carbon::createFromFormat('H:i:s', $trip->waktu)->format('H:i') }}</p>
            </div>

            <!-- Kolom 2: Form -->
            <div class="self-start">
                <div class="bg-white p-6 rounded-2xl shadow-md w-full">
                    <h2 class="text-xl font-semibold text-center text-pine mb-4">Form Pemesanan</h2>
                    <p class="text-xl font-bold text-gray-800 mb-4">Rp{{ number_format($trip->harga, 0, ',', '.') }}</p>

                    @auth
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_trip" value="{{ $trip->id }}">

                        {{-- Data Pemesan --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Nama Pemesan</label>
                            <input type="text" name="nama" class="w-full border border-gray-300 rounded-md p-2" placeholder="Nama lengkap Anda" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
                            <input type="tel" name="nomor_telepon" class="w-full border border-gray-300 rounded-md p-2" placeholder="Nomor telepon aktif" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email" class="w-full border border-gray-300 rounded-md p-2" placeholder="Email aktif" required>
                        </div>

                        <div class="mb-4">
                            <button type="button" id="copyPemesanToPeserta" class="text-sm text-blue-600 underline hover:text-blue-800">Samakan dengan data pemesan</button>
                        </div>

                        {{-- Jumlah & Data Peserta --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Jumlah Peserta</label>
                            <input type="number" id="jumlahPeserta" name="jumlah_peserta" class="w-full border border-gray-300 rounded-md p-2" min="1" required>
                        </div>
                        <div id="pesertaFields" class="space-y-4 mt-4"></div>

                        {{-- Paket --}}
                        @if($trip->paket)
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Pilih Paket</label>
                            <select name="paket" class="w-full border border-gray-300 rounded-md p-2" required>
                                @foreach (explode(',', $trip->paket) as $paket)
                                <option value="{{ trim($paket) }}">{{ ucfirst(trim($paket)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        {{-- Catatan Khusus --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Catatan Khusus</label>
                            <textarea name="catatan_khusus" class="w-full border border-gray-300 rounded-md p-2" rows="4" placeholder="Tulis jika ada permintaan khusus..."></textarea>
                        </div>

                        {{-- Checkbox persetujuan --}}
                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" required>
                                <span class="ml-2 text-sm">Saya setuju dengan <a href="#" class="text-blue-500">syarat & ketentuan</a>.</span>
                            </label>
                        </div>

                        <button type="submit" class="bg-forest text-white px-4 py-2 rounded-md w-full hover:bg-pine transition">Pesan Sekarang</button>
                    </form>
                    @else
                    <p class="text-center text-red-500 font-semibold mt-4">Login dulu ya sebelum memesan. <a href="{{ route('login') }}" class="text-blue-500 underline">Klik di sini untuk login</a>.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jumlahPesertaInput = document.getElementById('jumlahPeserta');
        const pesertaFieldsContainer = document.getElementById('pesertaFields');
        const btnCopy = document.getElementById('copyPemesanToPeserta');

        jumlahPesertaInput.addEventListener('input', function () {
            const jumlah = parseInt(this.value);
            pesertaFieldsContainer.innerHTML = '';
            if (!isNaN(jumlah) && jumlah > 0) {
                for (let i = 1; i <= jumlah; i++) {
                    pesertaFieldsContainer.insertAdjacentHTML('beforeend', `
                        <div class="border p-4 rounded-md bg-mist">
                            <h3 class="font-semibold mb-2 text-forest">Data Peserta ${i}</h3>
                            <div class="mb-2">
                                <label class="block text-sm font-medium mb-1">Nama</label>
                                <input type="text" name="peserta[${i}][nama]" required class="w-full border border-gray-300 rounded-md p-2">
                            </div>
                            <div class="mb-2">
                                <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
                                <input type="tel" name="peserta[${i}][telepon]" required class="w-full border border-gray-300 rounded-md p-2">
                            </div>
                            <div class="mb-2">
                                <label class="block text-sm font-medium mb-1">Email</label>
                                <input type="email" name="peserta[${i}][email]" required class="w-full border border-gray-300 rounded-md p-2">
                            </div>
                        </div>
                    `);
                }
            }
        });

        btnCopy?.addEventListener('click', function () {
            const nama = document.querySelector('input[name="nama"]').value;
            const telp = document.querySelector('input[name="nomor_telepon"]').value;
            const email = document.querySelector('input[name="email"]').value;
            const peserta1 = pesertaFieldsContainer.querySelector('div.border');
            if (peserta1) {
                peserta1.querySelector(`input[name="peserta[1][nama]"]`).value = nama;
                peserta1.querySelector(`input[name="peserta[1][telepon]"]`).value = telp;
                peserta1.querySelector(`input[name="peserta[1][email]"]`).value = email;
            } else {
                alert('Masukkan jumlah peserta terlebih dahulu!');
            }
        });
    });
</script>
@endsection
