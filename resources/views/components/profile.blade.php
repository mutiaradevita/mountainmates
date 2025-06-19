@auth
    {{-- Dropdown Saat Login --}}
    <div class="relative group">
        <button class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-gray-100 focus:outline-none">
            <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A10.97 10.97 0 0112 15c2.5 0 4.847.82 6.879 2.204M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            {{ Auth::user()->name }}
            <svg class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
            </svg>
        </button>

        {{-- Dropdown Menu --}}
        <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-150 z-50">
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Riwayat</a>
            <a href="{{ route('peserta.ulasan') }}" class="block px-4 py-2 hover:bg-gray-100">Ulasan</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="block">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
            </form>
        </div>
    </div>
@else
    {{-- Kalau belum login --}}
    <a href="{{ route('login') }}" class="px-4 py-2 border border-pine text-pine rounded-md hover:bg-mist transition">Masuk</a>
    <a href="{{ route('register') }}" class="px-4 py-2 bg-pine text-white rounded-md hover:bg-forest transition">Daftar</a>
@endauth
