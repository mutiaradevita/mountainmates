<x-home-layout>
  {{-- HERO SECTION --}}
  <section class="bg-mist py-12 mb-12 border border-red-500">
    <div class="max-w-screen-xl mx-auto px-4 text-center">
      <h1 class="text-2xl md:text-3xl font-bold text-forest mb-4">Cari petualangan seru?</h1>
      <div class="max-w-xl mx-auto">
        <input
          type="text"
          placeholder="Cari trip, gunung, atau lokasi"
          class="w-full px-6 py-3 rounded-full border border-stone text-stone placeholder:text-stone focus:outline-none focus:ring-2 focus:ring-forest"
        >
      </div>
    </div>
  </section>

  {{-- BANNER SECTION --}}
  <section class="bg-mist mb-12">
    <div class="max-w-screen-xl mx-auto px-4 py-6">
      <img src="{{ asset('img/BANNER.jpg') }}"
           alt="Simulasi Harga Tiket"
           class="w-full rounded-lg shadow-md object-cover">
    </div>
  </section>

<!-- Trip Cards -->
<section class="bg-sunset py-12 mb-12">
  <div class="max-w-screen-xl mx-auto px-4">
    <h2 class="text-white text-xl font-bold mb-6">TRIP PALING LARIS</h2>
    <div class="flex space-x-4 gap-4 overflow-x-auto pb-2">
           <!-- Kartu 1 -->
<div class="bg-snow rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
  <img src="{{ asset('img/gunung.jpeg') }}" alt="Trip Bromo" class="w-full h-48 object-cover">
  <div class="p-4">
    <h3 class="text-pine text-base font-semibold">OPEN TRIP BROMO</h3>
    <div class="text-sm text-stone mt-1 flex items-center gap-2">
      <svg class="w-4 h-4 text-stone" fill="currentColor" viewBox="0 0 20 20">
        <path d="M6 2a2 2 0 00-2 2v1H3a1 1 0 100 2h1v2H3a1 1 0 100 2h1v2H3a1 1 0 100 2h1v1a2 2 0 002 2h8a2 2 0 002-2v-1h1a1 1 0 100-2h-1v-2h1a1 1 0 100-2h-1V7h1a1 1 0 100-2h-1V4a2 2 0 00-2-2H6z" />
      </svg>
      20 - 22 Juni 2025 · Bromo
    </div>
    <p class="text-earth font-bold mt-2">Rp 650.000</p>
    <p class="text-sm text-moss mt-1">Mountain Mates</p>
  </div>
</div>

<!-- Kartu 2 -->
<div class="bg-snow rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
  <img src="{{ asset('img/gunung.jpeg') }}" alt="Trip Papandayan" class="w-full h-48 object-cover">
  <div class="p-4">
    <h3 class="text-forest text-base font-semibold">OPEN TRIP PAPANDAYAN</h3>
    <div class="text-sm text-stone mt-1 flex items-center gap-2">
      <svg class="w-4 h-4 text-stone" fill="currentColor" viewBox="0 0 20 20">
        <path d="M6 2a2 2 0 00-2 2v1H3a1 1 0 100 2h1v2H3a1 1 0 100 2h1v2H3a1 1 0 100 2h1v1a2 2 0 002 2h8a2 2 0 002-2v-1h1a1 1 0 100-2h-1v-2h1a1 1 0 100-2h-1V7h1a1 1 0 100-2h-1V4a2 2 0 00-2-2H6z" />
      </svg>
      5 - 6 Juli 2025 · Garut
    </div>
    <p class="text-earth font-bold mt-2">Rp 550.000</p>
    <p class="text-sm text-moss mt-1">Mountain Mates</p>
  </div>
</div>

<!-- Kartu 3 -->
<div class="bg-snow rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
  <img src="{{ asset('img/gunung.jpeg') }}" alt="Trip Rinjani" class="w-full h-48 object-cover">
  <div class="p-4">
    <h3 class="text-forest text-base font-semibold">OPEN TRIP RINJANI</h3>
    <div class="text-sm text-stone mt-1 flex items-center gap-2">
      <svg class="w-4 h-4 text-stone" fill="currentColor" viewBox="0 0 20 20">
        <path d="M6 2a2 2 0 00-2 2v1H3a1 1 0 100 2h1v2H3a1 1 0 100 2h1v2H3a1 1 0 100 2h1v1a2 2 0 002 2h8a2 2 0 002-2v-1h1a1 1 0 100-2h-1v-2h1a1 1 0 100-2h-1V7h1a1 1 0 100-2h-1V4a2 2 0 00-2-2H6z" />
      </svg>
      10 - 15 Agustus 2025 · Lombok
    </div>
    <p class="text-earth font-bold mt-2">Rp 1.200.000</p>
    <p class="text-sm text-moss mt-1">Mountain Mates</p>
  </div>
</div>
    </div>
</section>


 <!-- Join Section -->
<section class="bg-pine text-snow py-12 mb-12">
  <div class="max-w-screen-xl mx-auto px-6 md:px-12 flex flex-col md:flex-row items-center justify-between gap-10">
    
    <!-- Teks -->
    <div class="md:w-1/2">
      <h2 class="text-2xl md:text-3xl font-bold mb-4">BERGABUNGLAH</h2>
      <p class="text-base md:text-lg mb-6 leading-relaxed">
        Daftarkan tripmu dan jadikan eventmu semakin seru bersama sahabat baru!
      </p>
      <a href="#" class="inline-block bg-snow text-forest px-6 py-3 rounded-full font-semibold shadow hover:bg-mist transition">
        Daftar Sekarang
      </a>
    </div>

    <!-- Gambar -->
    <div class="md:w-1/2">
      <img src="{{ asset('img/join.png') }}" alt="Ilustrasi Join" class="w-full max-w-md mx-auto md:mx-0" />
    </div>

  </div>
</section>
</x-home-layout>
