<x-home-layout>
    <div class="pt-[80px] pb-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-3xl font-bold text-pine text-center mb-10">Ulasan Saya</h1> {{-- Jarak dibesarin di sini --}}

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
                            <div class="flex items-center justify-between mb-2">
                                <h2 class="text-xl font-semibold text-forest">{{ $ulasan->trip->nama_trip }}</h2>
                                <span class="inline-block bg-yellow-100 text-yellow-700 text-sm font-semibold px-3 py-1 rounded-full">
                                    ⭐ {{ $ulasan->rating }} / 5
                                </span>
                            </div>
                            <p class="text-gray-700 italic mb-3">"{{ $ulasan->komentar }}"</p>
                            <p class="text-sm text-gray-500 text-right">
                                Diulas pada {{ $ulasan->created_at->translatedFormat('d M Y') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-home-layout>
