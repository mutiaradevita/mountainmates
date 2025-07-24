@extends('layouts.app')

@section('content')
<div class="bg-snow min-h-[calc(100vh-100px)] flex items-center justify-center px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-pine mb-4">📝 Beri Ulasan untuk Trip: {{ $transaksi->trip->nama_trip }}</h2>

        <form action="{{ route('peserta.ulasan.store', $transaksi->id) }}" method="POST">
            @csrf

            <label class="block mb-2 text-sm text-gray-700 font-medium">Rating:</label>
     <div class="flex gap-1 mb-4" id="star-rating">
        @for ($i = 1; $i <= 5; $i++)
            <input type="radio" name="rating" value="{{ $i }}" id="rating-{{ $i }}" class="hidden">
            <label for="rating-{{ $i }}" class="text-2xl cursor-pointer text-gray-300" data-value="{{ $i }}">★</label>
        @endfor
    </div>

            <label class="block mb-2 text-sm text-gray-700 font-medium">Komentar:</label>
            <textarea name="komentar" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-pine focus:border-pine">{{ old('komentar') }}</textarea>

            <button type="submit" class="mt-4 bg-pine text-white px-4 py-2 rounded hover:bg-forest">Kirim Ulasan</button>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('#star-rating label');
        const inputs = document.querySelectorAll('#star-rating input');

        stars.forEach((star, index) => {
            star.addEventListener('click', function () {
                // Atur semua warna bintang ke abu
                stars.forEach(s => s.classList.remove('text-yellow-400'));
                stars.forEach(s => s.classList.add('text-gray-300'));

                // Warnai dari awal sampai bintang yang diklik
                for (let i = 0; i <= index; i++) {
                    stars[i].classList.remove('text-gray-300');
                    stars[i].classList.add('text-yellow-400');
                }

                // Set radio button sesuai nilai
                inputs[index].checked = true;
            });
        });
    });
</script>
<div class="hidden">
    <span class="text-yellow-400"></span>
    <span class="text-gray-300"></span>
</div>
@endsection
