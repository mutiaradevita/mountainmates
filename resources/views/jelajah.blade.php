<x-home-layout>
    <!-- Cari Section -->
    <section class="bg-pine text-snow pt-[80px] pb-12">
        <div class="px-4 md:px-6 lg:px-8 py-10 text-center">
            <h1 class="text-3xl md:text-4xl font-bold">Jelajah</h1>
            <p class="text-lg mt-2">Dan temukan banyak <span class="font-semibold text-sunset">Event</span> seru-mu disini!</p>
            <div class="mt-6 flex justify-center">
              <img src="{{ asset('img/ilustrasi.png') }}" alt="Jelajah Icon" class="h-16">
            </div>
          </div>
    </section>

    {{-- Search Bar --}}
    <section class="bg-snow py-6">
      <div class="container mx-auto px-4">
        <div class="flex justify-center">
          <div class="relative w-full max-w-2xl">
            <input type="text" placeholder="Cari sesuatu disini"
              class="w-full border border-stone px-6 py-3 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-forest">
            <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-forest">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 16.65z" /></svg>
            </button>
          </div>
        </div>
      </div>
    </section>

    {{-- Filter dan Urutkan --}}
    <section class="bg-mist py-4">
      <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="flex space-x-4">
          <button class="bg-white px-4 py-2 rounded-md border border-stone text-pine font-medium shadow-sm">Lokasi</button>
          <button class="bg-white px-4 py-2 rounded-md border border-stone text-pine font-medium shadow-sm">Kategori</button>
        </div>
        <div>
          <button class="bg-sunset text-white px-4 py-2 rounded-md shadow-sm hover:bg-forest transition">Terbaru</button>
        </div>
      </div>
    </section>

    <!-- Trip Cards -->
    <section id="trip" class="bg-snow py-12 mb-12">
      <div class="max-w-screen-xl mx-auto px-4">
        <h2 class="text-pine text-xl font-bold mb-6">TRIP TERBARU</h2>
        <div class="flex space-x-4 gap-4 overflow-x-auto pb-2">
          @forelse ($trips as $trip)
            <a href="{{ route('jelajah.detail', $trip->id) }}" class="min-w-[250px] bg-snow rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
              <img src="{{ asset('storage/' . $trip->flyer) }}" alt="Trip {{ $trip->nama_trip }}" class="w-full h-48 object-cover">
              <div class="p-4">
                <h3 class="text-pine text-base font-semibold">{{ strtoupper($trip->nama_trip) }}</h3>
                <div class="text-sm text-stone mt-1 flex items-center gap-2">
                  <svg class="w-4 h-4 text-stone" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6 2a2 2 0 00-2 2v1H3a1 1 0 100 2h1v2H3a1 1 0 100 2h1v2H3a1 1 0 100 2h1v1a2 2 0 002 2h8a2 2 0 002-2v-1h1a1 1 0 100-2h-1v-2h1a1 1 0 100-2h-1V7h1a1 1 0 100-2h-1V4a2 2 0 00-2-2H6z" />
                  </svg>
                  {{ \Carbon\Carbon::parse($trip->tanggal_trip)->format('d M Y') }} · {{ $trip->lokasi }}
                </div>
                <p class="text-earth font-bold mt-2">Rp {{ number_format($trip->harga, 0, ',', '.') }}</p>
                <p class="text-sm text-moss mt-1">{{ $trip->pengelola->name ?? 'Mountain Mates' }}</p>
              </div>
            </a>
          @empty
            <p class="text-sm text-stone">Belum ada trip tersedia.</p>
          @endforelse
        </div>
      </div>
    </section>
</x-home-layout>
