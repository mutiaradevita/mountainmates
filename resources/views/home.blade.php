<x-home-layout>
    <!-- Cari Section -->
    <section class="bg-pine text-snow pt-[80px] pb-12">
        <div class="px-4 md:px-6 lg:px-8 py-10 text-center">
            <h1 class="text-2xl md:text-3xl font-bold text-pine mb-4">Cari petualangan seru?</h1>
            <div class="max-w-xl mx-auto">
                <input
                    type="text"
                    placeholder="Cari trip, gunung, atau lokasi"
                    class="w-full px-6 py-3 rounded-full border border-stone text-stone placeholder:text-stone focus:outline-none focus:ring-2 focus:ring-forest"
                >
            </div>
        </div>
    </section>

    <!-- Berita Pendakian Section -->
    <section class="bg-mist py-8">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-xl font-bold text-pine mb-4">Berita Pendakian</h2>
            <div class="swiper news-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="https://www.tnbs.or.id/berita/semeru-ditutup" target="_blank"
                           class="block rounded-lg overflow-hidden shadow-md group">
                            <div class="relative h-64 md:h-72 bg-cover bg-center transition-transform group-hover:scale-[1.01]"
                                 style="background-image: url('{{ asset('img/semeru.jpg') }}')">
                                <div class="absolute inset-0 bg-black bg-opacity-50 p-4 flex flex-col justify-end">
                                    <h3 class="text-snow text-lg font-semibold group-hover:underline">Gunung Semeru Ditutup Sementara</h3>
                                    <p class="text-snow text-sm">Mulai 1 Juni 2025, karena aktivitas vulkanik.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trip Paling Laris Section -->
    <section class="bg-snow py-12">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-pine text-xl font-bold mb-6">TRIP PALING LARIS</h2>
            <div class="flex space-x-4 gap-4 overflow-x-auto pb-2 scroll-smooth">

                <!-- Kartu Trip 1 -->
                <div class="bg-snow rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 min-w-[250px] max-w-[280px]">
                    <img src="{{ asset('img/gunung.jpeg') }}" alt="Trip Bromo" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-forest text-base font-semibold">OPEN TRIP BROMO</h3>
                        <div class="text-sm text-stone mt-1 flex items-center gap-2">
                            <svg class="w-4 h-4 text-stone" fill="currentColor" viewBox="0 0 20 20"><path d="..." /></svg>
                            20 - 22 Juni 2025 · Bromo
                        </div>
                        <p class="text-earth font-bold mt-2">Rp 650.000</p>
                        <p class="text-sm text-forest mt-1">Mountain Mates</p>
                    </div>
                </div>

                <!-- Kartu Trip 2 -->
                <div class="bg-snow rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 min-w-[250px] max-w-[280px]">
                    <img src="{{ asset('img/gunung.jpeg') }}" alt="Trip Papandayan" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-forest text-base font-semibold">OPEN TRIP PAPANDAYAN</h3>
                        <div class="text-sm text-stone mt-1 flex items-center gap-2">
                            <svg class="w-4 h-4 text-stone" fill="currentColor" viewBox="currentColor"><path d="..." /></svg>
                            5 - 6 Juli 2025 · Garut
                        </div>
                        <p class="text-earth font-bold mt-2">Rp 550.000</p>
                        <p class="text-sm text-forest mt-1">Mountain Mates</p>
                    </div>
                </div>

                <!-- Kartu Trip 3 -->
                <div class="bg-snow rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 min-w-[250px] max-w-[280px]">
                    <img src="{{ asset('img/gunung.jpeg') }}" alt="Trip Rinjani" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-forest text-base font-semibold">OPEN TRIP RINJANI</h3>
                        <div class="text-sm text-stone mt-1 flex items-center gap-2">
                            <svg class="w-4 h-4 text-stone" fill="currentColor" viewBox="currentColor"><path d="..." /></svg>
                            10 - 15 Agustus 2025 · Lombok
                        </div>
                        <p class="text-earth font-bold mt-2">Rp 1.200.000</p>
                        <p class="text-sm text-forest mt-1">Mountain Mates</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Testimoni Peserta Section -->
    <section class="bg-pine py-8">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-xl font-bold text-snow mb-4">Testimoni Peserta</h2>
            <div class="flex space-x-4 gap-4 overflow-x-auto pb-2 scroll-smooth">

                <!-- Testimoni 1 -->
                <div class="bg-white rounded-xl p-6 shadow-md w-64">
                    <p class="text-stone text-base mb-4">"Pengalaman yang luar biasa, pendakian yang menantang namun sangat menyenangkan. Highly recommended!"</p>
                    <h4 class="font-semibold text-pine">Andi Susanto</h4>
                    <p class="text-sm text-stone">Pendaki</p>
                </div>

                <!-- Testimoni 2 -->
                <div class="bg-white rounded-xl p-6 shadow-md w-64">
                    <p class="text-stone text-base mb-4">"Tim yang sangat profesional dan ramah. Saya merasa aman dan puas dengan perjalanan ini!"</p>
                    <h4 class="font-semibold text-pine">Rina Marwati</h4>
                    <p class="text-sm text-stone">Pendaki</p>
                </div>

                <!-- Testimoni 3 -->
                <div class="bg-white rounded-xl p-6 shadow-md w-64">
                    <p class="text-stone text-base mb-4">"Sungguh pengalaman tak terlupakan, tempat yang indah dan teman-teman baru yang seru!"</p>
                    <h4 class="font-semibold text-pine">Budi Santoso</h4>
                    <p class="text-sm text-stone">Pendaki</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="bg-mist py-8">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-xl font-bold text-pine mb-4">Blog Terbaru</h2>
            <div class="flex space-x-4 gap-4 overflow-x-auto pb-2 scroll-smooth">

                <!-- Blog 1 -->
                <div class="bg-snow rounded-xl p-6 shadow-md w-64">
                    <h4 class="text-forest font-semibold mb-4">Petualangan Seru di Gunung Bromo</h4>
                    <p class="text-stone text-base mb-4">Gunung Bromo menyajikan pemandangan yang luar biasa. Kami akan membawa Anda melewati padang pasir yang luas dan puncak gunung yang menantang.</p>
                    <a href="#" class="text-sm text-forest hover:underline">Baca Selengkapnya</a>
                </div>

                <!-- Blog 2 -->
                <div class="bg-snow rounded-xl p-6 shadow-md w-64">
                    <h4 class="text-forest font-semibold mb-4">Tips Pendakian Aman di Alam Liar</h4>
                    <p class="text-stone text-base mb-4">Berikut beberapa tips yang perlu Anda ketahui untuk melakukan pendakian dengan aman, terutama bagi pendaki pemula yang baru memulai perjalanan mereka.</p>
                    <a href="#" class="text-sm text-forest hover:underline">Baca Selengkapnya</a>
                </div>

                <!-- Blog 3 -->
                <div class="bg-snow rounded-xl p-6 shadow-md w-64">
                    <h4 class="text-forest font-semibold mb-4">Menjelajahi Keindahan Alam Gunung Papandayan</h4>
                    <p class="text-stone text-base mb-4">Gunung Papandayan adalah salah satu destinasi yang menawarkan perjalanan mendalam dengan keindahan alam yang memukau. Ikuti perjalanan kami untuk mengeksplorasi lebih banyak!</p>
                    <a href="#" class="text-sm text-forest hover:underline">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>
</x-home-layout>
