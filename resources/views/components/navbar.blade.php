<nav class="fixed top-0 w-full h-[80px] z-50 bg-snow border-b border-gray-200 shadow-sm backdrop-blur-sm">
    <div class="max-w-screen-xl mx-auto h-full px-6 flex items-center justify-between">

        {{-- KIRI: Logo --}}
        <div class="flex items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-16 object-contain">
            </a>
        </div>

        {{-- TENGAH: Menu --}}
        <div class="hidden md:flex items-center space-x-8 text-stone font-medium">
            <a href="{{ route('jelajah') }}" class="hover:text-forest flex items-center gap-1">
                Jelajah
            </a>
            <a href="#" class="hover:text-forest flex items-center gap-1">
                Ulasan
            </a>
            <a href="#" class="hover:text-forest flex items-center gap-1">
                Blog
            </a>
            <a href="#" class="hover:text-forest flex items-center gap-1">
                Hubungi Kami
            </a>
        </div>

        {{-- KANAN: Login/Register ATAU Dropdown --}}
        @auth
            <!-- Dropdown untuk yang sudah login -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-2 text-pine font-semibold hover:text-forest">
                    <div class="w-8 h-8 rounded-full bg-[#EDF2F7] flex items-center justify-center">
                        <div class="w-8 h-8 rounded-full bg-[#EDF2F7] flex items-center justify-center">
                            <svg class="w-5 h-5 text-pine" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a4 4 0 100 8 4 4 0 000-8zM2 16a8 8 0 1116 0H2z" clip-rule="evenodd" />
                            </svg>
                        </div>
                            <svg class="h-4 w-4 text-pine" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l5 5 5-5" />
                            </svg>
                </button>

                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:leave="transition ease-in duration-200"
                    class="absolute right-0 mt-3 w-64 bg-white rounded-xl shadow-xl z-50 border border-gray-200 py-2">
                    {{-- <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 hover:bg-gray-100">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A4 4 0 017 16h10a4 4 0 011.879.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                        Profile
                    </a>
                    <a href="{{ route('my-tickets') }}" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 hover:bg-gray-100">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A4 4 0 017 16h10a4 4 0 011.879.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                        My Tiket
                    </a>
                    <a href="{{ route('reviews') }}" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 hover:bg-gray-100">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A4 4 0 017 16h10a4 4 0 011.879.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                        Rating & Reviews
                    </a> --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-5 py-3 text-sm text-gray-700 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M216 48v160a16 16 0 0 1-16 16H104a8 8 0 0 1 0-16h96V48H104a8 8 0 0 1 0-16h96a16 16 0 0 1 16 16Zm-49.6 77.7-40-40a8.1 8.1 0 0 0-11.3 11.3L140.7 120H40a8 8 0 0 0 0 16h100.7l-25.6 23.9a8.1 8.1 0 0 0 11.3 11.4l40-40a8.2 8.2 0 0 0 0-11.3Z"/>
                                </svg>
                                    Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Login/Register sebelum login -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('login') }}" class="px-4 py-2 border border-pine text-pine rounded-md hover:bg-mist transition">Masuk</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-pine text-white rounded-md hover:bg-forest transition">Daftar</a>
            </div>
        @endauth
    </div>
</nav>
