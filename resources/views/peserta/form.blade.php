@extends('layouts.app')

@section('content')
<section class="bg-snow min-h-[calc(100vh-100px)] py-8 px-4">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

            <!-- Kolom 1: Info Trip -->
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <img src="{{ asset('storage/' . $trip->flyer) }}" alt="{{ $trip->nama_trip }}"
                    class="w-full h-64 object-cover rounded-lg mb-4">
                <h1 class="text-2xl font-bold text-pine mb-2">{{ $trip->nama_trip }}</h1>
                <p class="text-gray-700 mb-2">{{ $trip->deskripsi_trip }}</p>
                <p class="text-sm text-gray-700">Lokasi: {{ $trip->lokasi }}</p>
                <p class="text-sm text-gray-700">Tanggal Trip: {{ \Carbon\Carbon::parse($trip->tanggal_trip)->translatedFormat('d F Y') }}</p>
                <p class="text-sm text-gray-700">Waktu: {{ \Carbon\Carbon::createFromFormat('H:i:s', $trip->waktu)->format('H:i') }}</p>
                <p class="text-sm text-gray-700">Kuota Maksimum: {{ $trip->kuota }} peserta</p>
                <p class="text-sm text-red-600 font-semibold">Sisa Kuota: {{ $trip->kuota - $trip->transaksi()->where('status', '!=', 'batal')->sum('jumlah_peserta') }} peserta</p>
            </div>

            <!-- Kolom 2: Form -->
            <div class="self-start">
                <div class="bg-white p-6 rounded-2xl shadow-md w-full">
                    <h2 class="text-xl font-semibold text-center text-pine mb-4">Form Pemesanan</h2>
                    @auth
                    @php
                        $terisi = $trip->transaksi()->where('status', '!=', 'batal')->sum('jumlah_peserta');
                        $sisaKuota = $trip->kuota - $terisi;
                    @endphp
                    @if ($sisaKuota <= 0)
                        <p class="text-center text-red-600 font-semibold">Kuota penuh! Tidak bisa melakukan pemesanan.</p>
                    @else
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_trip" value="{{ $trip->id }}">
                        <input type="hidden" name="harga" value="{{ $trip->harga }}">

                    {{-- Data Pemesan --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1 text-gray-800">Nama Pemesan</label>
                        <input type="text" name="nama"
                            class="form-input w-full border border-gray-300 rounded-md p-2 placeholder-gray-500 text-gray-800"
                            placeholder="Nama Lengkap Anda"
                            value="{{ old('nama', Auth::user()->name) }}"
                            required>
                        @error('nama')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1 text-gray-800">Nomor Telepon</label>
                        <input type="tel" name="nomor_telepon"
                            class="form-input w-full border border-gray-300 rounded-md p-2 placeholder-gray-500 text-gray-800"
                            placeholder="Nomor Telepon Aktif"
                            value="{{ old('nomor_telepon', Auth::user()->phone ?? '') }}"
                            required>
                        @error('nomor_telepon')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1 text-gray-800">Email</label>
                        <input type="email" name="email"
                            class="form-input w-full border border-gray-300 rounded-md p-2 placeholder-gray-500 text-gray-800"
                            placeholder="Email Aktif"
                            value="{{ old('email', Auth::user()->email) }}"
                            required>
                        @error('email')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jumlah Peserta --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1 text-gray-800">Jumlah Peserta</label>
                        <input type="number" id="jumlahPeserta" name="jumlah_peserta" 
                            min="1" max="{{ $sisaKuota }}" 
                            required 
                            class="form-input w-full border border-gray-300 rounded-md p-2 placeholder-gray-500 text-gray-800"/>
                        @error('jumlah_peserta')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="pesertaFields" class="space-y-4 mt-4"></div>
                    @error('peserta')
                        <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                    @enderror

                    {{-- Paket --}}
                    @if(!empty($trip->paket))
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1 text-gray-800">Pilih Paket</label>
                            <select name="paket" class="form-input w-full border border-gray-300 rounded-md p-2 placeholder-gray-500 text-gray-800" required>
                                <option value="" disabled selected hidden>Pilih paket trip</option>
                                @foreach (explode(',', $trip->paket) as $paket)
                                    <option value="{{ trim($paket) }}" class="text-gray-800"
                                        {{ old('paket') == trim($paket) ? 'selected' : '' }}>
                                        {{ ucfirst(trim($paket)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    {{-- Catatan Khusus --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1 text-gray-800">Catatan Khusus</label>
                        <textarea name="catatan_khusus"
                            class="form-input w-full border border-gray-300 rounded-md p-2 placeholder-gray-500 text-gray-800"
                            rows="4" placeholder="Tulis jika ada catatan khusus...">{{ old('catatan_khusus') }}</textarea>
                        @error('catatan_khusus')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
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
                    @endif
                    @else
                    <p class="text-center text-red-500 font-semibold mt-4">Login dulu ya sebelum memesan. </p>
                    <p class="text-center text-sm font-semibold"> <a href="{{ route('login') }}" class=" text-blue-500 underline">Klik di sini untuk login</a>.</p>
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

    function renderPesertaFields(jumlah, data = {}) {
        pesertaFieldsContainer.innerHTML = '';
        for (let i = 1; i <= jumlah; i++) {
            let isFirst = i === 1;
            pesertaFieldsContainer.insertAdjacentHTML('beforeend', `
                <div class="border p-4 rounded-md bg-mist">
                    <h3 class="font-semibold mb-2 text-forest">Data Peserta ${i}</h3>
                    ${isFirst ? `
                        <label class="inline-flex items-center mb-3">
                            <input type="checkbox" id="copyFromPemesan" class="form-checkbox mr-2">
                            <span class="text-sm text-gray-700">Samakan dengan data pemesan</span>
                        </label>
                    ` : ''}
                    <div class="mb-2">
                        <label class="block text-sm font-medium mb-1">Nama</label>
                        <input type="text" name="peserta[${i}][nama]" value="${data[i]?.nama || ''}" required class="w-full border border-gray-300 rounded-md p-2 text-gray-800">
                    </div>
                    <div class="mb-2">
                        <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
                        <input type="tel" name="peserta[${i}][telepon]" value="${data[i]?.telepon || ''}" required class="w-full border border-gray-300 rounded-md p-2 text-gray-800">
                    </div>
                    <div class="mb-2">
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="peserta[${i}][email]" value="${data[i]?.email || ''}" required class="w-full border border-gray-300 rounded-md p-2 text-gray-800">
                    </div>
                </div>
            `);
        }

        // Checkbox: samakan dengan pemesan
        setTimeout(() => {
            const checkbox = document.getElementById('copyFromPemesan');
            if (checkbox) {
                checkbox.addEventListener('change', function () {
                    const nama = document.querySelector('input[name="nama"]').value;
                    const telp = document.querySelector('input[name="nomor_telepon"]').value;
                    const email = document.querySelector('input[name="email"]').value;

                    const peserta1 = pesertaFieldsContainer.querySelector('div.border');
                    if (peserta1) {
                        peserta1.querySelector(`input[name="peserta[1][nama]"]`).value = this.checked ? nama : '';
                        peserta1.querySelector(`input[name="peserta[1][telepon]"]`).value = this.checked ? telp : '';
                        peserta1.querySelector(`input[name="peserta[1][email]"]`).value = this.checked ? email : '';
                    }
                });
            }
        }, 50);
    }

    jumlahPesertaInput?.addEventListener('input', function () {
        const jumlah = parseInt(this.value);
        const max = parseInt(this.getAttribute('max'));
        if (!isNaN(jumlah) && jumlah > 0) {
            if (jumlah > max) {
                alert(`Jumlah peserta melebihi sisa kuota (${max})`);
                this.value = max;
                renderPesertaFields(max);
            } else {
                renderPesertaFields(jumlah);
            }
        } else {
            pesertaFieldsContainer.innerHTML = ''; 
        }
    });

    @if (old('jumlah_peserta'))
        const jumlahOld = {{ old('jumlah_peserta') }};
        const pesertaData = @json(old('peserta'));
        document.getElementById('jumlahPeserta').value = jumlahOld;
        renderPesertaFields(jumlahOld, pesertaData);

        document.getElementById('jumlahPeserta').dispatchEvent(new Event('input'));
    @endif
});
</script>
@endsection