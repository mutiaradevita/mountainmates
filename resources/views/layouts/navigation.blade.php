<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow z-50">
    @php
        $user = Auth::user();
        $dashboardRoute = match ($user->role) {
            'admin' => route('admin.dashboard'),
            'pengelola' => route('pengelola.dashboard'),
            default => route('home'),
        };
    @endphp

    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <a href="{{ $dashboardRoute }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-16 object-contain">
                </a>
                <span class="font-bold text-lg text-gray-700">Mountain Mates</span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ $dashboardRoute }}" class="text-sm font-medium text-gray-600 hover:text-pine transition">Dashboard</a>

                @if ($user->role === 'pengelola')
                    <a href="{{ route('trips.index') }}" class="text-sm font-medium text-gray-600 hover:text-pine transition">Trip Saya</a>
                @endif

                <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-gray-600 hover:text-pine transition">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-600 transition">Keluar</button>
                </form>
            </div>
    </div>
</nav>
