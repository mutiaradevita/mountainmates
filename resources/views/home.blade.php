<x-home-layout>
    <!-- Hero Section -->
    <section id="beranda" class="bg-pine text-snow pt-[80px] pb-12 min-h-screen flex items-center">
        <div class="container mx-auto px-4 md:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-10 py-10">
            
            {{-- Gambar --}}
            <div class="md:w-1/2">
                <img src="{{ asset('img/ilustrasi.png') }}" alt="Pendakian Gunung">
            </div>

            {{-- Teks --}}
            <div class="text-center md:text-left md:w-1/2">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Ayo Mendaki Bersama Kami!</h1>
                <p class="text-lg md:text-xl mb-6">Temukan trip pendakian terbaik & bergabung dengan komunitas pendaki</p>
                <a href="#trip-populer" class="inline-block px-6 py-3 bg-snow text-pine font-semibold rounded-full hover:bg-mist">Lihat Trip</a>
            </div>


        </div>
    </section>

   <!-- Tentang Kami & Keunggulan -->
<section class="bg-mist py-12 min-h-screen flex items-center">
    <div class="max-w-screen-xl mx-auto px-4 text-center">
        <h2 class="text-xl font-bold text-pine mb-4">Tentang Mountain Mates</h2>
        <p class="text-stone text-base max-w-2xl mx-auto mb-8">
            Mountain Mates adalah platform yang menghubungkan pendaki dengan penyedia jasa open trip terpercaya di Indonesia. Nikmati pengalaman mendaki gunung secara aman, mudah, dan terorganisir.
        </p>

        {{-- Keunggulan --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-10 text-left">
            <div class="bg-snow rounded-xl p-6 shadow-md">
                <h4 class="text-lg font-semibold text-pine mb-2">Pemandu Berpengalaman</h4>
                <p class="text-sm text-stone">Dipandu oleh profesional yang mengenal medan dengan baik.</p>
            </div>
            <div class="bg-snow rounded-xl p-6 shadow-md">
                <h4 class="text-lg font-semibold text-pine mb-2">Trip Terorganisir</h4>
                <p class="text-sm text-stone">Setiap perjalanan dirancang aman & nyaman.</p>
            </div>
            <div class="bg-snow rounded-xl p-6 shadow-md">
                <h4 class="text-lg font-semibold text-pine mb-2">Pembayaran Aman</h4>
                <p class="text-sm text-stone">Berbagai metode pembayaran terpercaya & transparan.</p>
            </div>
            <div class="bg-snow rounded-xl p-6 shadow-md">
                <h4 class="text-lg font-semibold text-pine mb-2">Komunitas Pendaki</h4>
                <p class="text-sm text-stone">Bergabung dalam komunitas inspiratif & suportif.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimoni Section -->
    <section id="ulasan" class="bg-pine py-12 min-h-screen flex items-center">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-center text-xl font-bold text-snow mb-4">Ulasan Peserta</h2>
            <div class="flex space-x-4 gap-4 overflow-x-auto pb-2 scroll-smooth">
                @forelse ($ulasans as $ulasan)
                    <div class="bg-snow rounded-xl p-6 shadow-md w-64">
                        <p class="text-stone text-base mb-4">"{{ $ulasan->komentar }}"</p>
                        <h4 class="font-semibold text-pine">{{ $ulasan->user->name ?? 'Peserta tidak ditemukan' }}</h4>
                        <p class="text-sm text-stone">Trip oleh: {{ $ulasan->trip->pengelola->name ?? '-' }}</p>
                    </div>
                @empty
                    <p class="text-left text-pine">Belum ada testimoni.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Trip Cards Section -->
    <section id="trip-populer" class="bg-snow py-12 min-h-screen flex items-center">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-pine text-xl font-bold mb-6">TRIP TERBARU</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($trips as $trip)
                    <a href="{{ route('jelajah.detail', $trip->id) }}" class="min-w-[250px] bg-snow rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="{{ asset('storage/' . $trip->flyer) }}" alt="Trip {{ $trip->nama_trip }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-pine text-base font-semibold">{{ strtoupper($trip->nama_trip) }}</h3>
                            <div class="text-sm text-stone mt-1 flex items-center gap-2">
                                <svg class="w-4 h-4 text-stone" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M6 2a2 2 0 00-2 2v1H3a1 1 0 100 2h1v2H3a1 1 0 100 2h1v2H3a1 1 0 100 2h1v1a2 2 0 002 2h8a2 2 0 002-2v-1h1a1 1 0 100-2h-1v-2h1a1 1 0 100-2h-1V7h1a1 1 0 100-2h-1V4a2 2 0 00-2-2H6z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($trip->tanggal_mulai)->format('d M Y') }} · {{ $trip->lokasi }}
                            </div>
                            <p class="text-earth font-bold mt-2">Rp {{ number_format($trip->harga, 0, ',', '.') }}</p>
                            <p class="text-sm text-moss mt-1">{{ $trip->pengelola->name ?? 'Mountain Mates' }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-sm text-stone">Belum ada trip tersedia.</p>
                @endforelse
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="inline-block bg-pine text-white px-5 py-2 rounded hover:bg-forest transition">
                    Lihat Semua Trip
                </a>
            </div>
        </div> 
    </section>

    <!-- Berita Terbaru -->
    <section id="berita" class="bg-mist py-12 min-h-screen flex items-center">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-center text-xl font-bold text-pine mb-6">Berita Pendakian</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($berita as $item)
                    <div class="bg-snow rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-40 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-pine">{{ $item->judul }}</h3>
                            <p class="text-sm text-stone mt-1">{{ \Illuminate\Support\Str::limit($item->deskripsi, 100) }}</p>
                            <a href="{{ $item->url }}" target="_blank" class="inline-block mt-3 text-sm text-earth font-semibold hover:underline">Baca Selengkapnya →</a>
                            <p class="text-xs text-moss mt-2">Sumber: {{ $item->sumber }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer CTA -->
    <section id="kontak" class="bg-pine py-12 text-center text-snow">
        <div class="max-w-xl mx-auto">
            <h3 class="text-left text-2xl font-bold mb-4">Siap Mendaki?</h3>
            <p class="mb-6">Daftar sekarang dan temukan petualangan terbaikmu bersama Mountain Mates.</p>
            <a href="{{ route('register') }}" class="px-6 py-3 bg-snow text-pine font-semibold rounded-full hover:bg-mist">Daftar Sekarang</a>
        </div>
    </section>
</x-home-layout>
