<nav class="fixed top-0 w-full h-[80px] z-50 bg-snow border-b border-gray-200 shadow-sm backdrop-blur-sm">
    <div class="max-w-screen-xl mx-auto h-full px-6 flex items-center justify-between">
        
        {{-- KIRI: Logo --}}
        <div class="flex items-center">
            <a href="#">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-16 object-contain">
            </a>
        </div>

        {{-- TENGAH: Menu --}}
        <div class="hidden md:flex items-center space-x-8 text-stone font-medium">
            <a href="{{ route('home') }}" class="hover:text-forest flex items-center gap-1">
                <svg class="h-5 w-5 text-forest" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4l-2 4H6l3.5 3-1 4L12 13l3.5 2-1-4L18 8h-4l-2-4z" />
                </svg>
                Jelajah
            </a>
            <a href="#" class="hover:text-forest flex items-center gap-1">
                <svg class="h-5 w-5 text-forest" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m2 0a2 2 0 100-4H7a2 2 0 000 4h10z" />
                </svg>
                Buat Event
            </a>
            <a href="#" class="hover:text-forest flex items-center gap-1">
                <svg class="h-5 w-5 text-forest" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 5.636A9 9 0 015.636 18.364M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Hubungi Kami
            </a>
        </div>

        {{-- KANAN: Tombol --}}
        <div class="hidden md:flex items-center space-x-4">
            <a href="#" class="px-4 py-2 border border-pine text-pine rounded-md hover:bg-mist transition">Masuk</a>
            <a href="#" class="px-4 py-2 bg-pine text-white rounded-md hover:bg-forest transition">Daftar</a>
        </div>
    </div>
</nav>
