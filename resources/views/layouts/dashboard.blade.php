<!DOCTYPE html>
<html lang="id"
  x-data="{ sidebarOpen: true, sidebarCollapsed: false }"
  x-init="
    sidebarOpen = JSON.parse(localStorage.getItem('sidebarOpen')) ?? true;
    sidebarCollapsed = JSON.parse(localStorage.getItem('sidebarCollapsed')) ?? false;
    $watch('sidebarOpen', val => localStorage.setItem('sidebarOpen', JSON.stringify(val)));
    $watch('sidebarCollapsed', val => localStorage.setItem('sidebarCollapsed', JSON.stringify(val)));
  "
>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Dashboard')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="..." crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="//unpkg.com/alpinejs" defer></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> 
</head>

<body class="bg-snow text-gray-800 min-h-screen flex">

  {{-- SIDEBAR --}}
  <aside
    :class="sidebarCollapsed ? 'w-20' : 'w-64'"
    class="bg-pine text-snow h-screen transition-all duration-300 ease-in-out flex flex-col"
  >
    <div class="flex items-center justify-between px-4 py-4 border-b border-moss">
      <div class="flex items-center gap-3">
        <img src="{{ asset('img/logo2.png') }}" alt="Logo" class="w-8 h-8 object-contain rounded-full" />
        <span x-show="!sidebarCollapsed" class="text-xl font-bold">Mountain Mates</span>
      </div>
      <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:block"></button>
    </div> 

    <nav class="p-4 text-sm space-y-2">
      @if(Auth::user()?->role === 'admin')
        <x-nav-link route="admin.dashboard" label="Dashboard" icon="dashboard" />
        <x-nav-link route="admin.berita.index" label="Berita" icon="newspaper" />
        <x-nav-link route="admin.user.index" label="Kelola User" icon="users" />
        <x-nav-link route="admin.trip.index" label="Data Trip" icon="mountains" />
        <x-nav-link route="admin.transaksi.index" label="Data Transaksi" icon="wallet" />
      @elseif(Auth::user()?->role === 'pengelola')
        <x-nav-link route="pengelola.dashboard" label="Dashboard" icon="dashboard" />
        <x-nav-link route="pengelola.trips.index" label="Kelola Trip" icon="mountains" />
        <x-nav-link route="pengelola.trips.history" label="Riwayat" icon="newspaper" />
        <x-nav-link route="pengelola.dokumentasi.index" label="Dokumentasi" icon="image" />
        <x-nav-link route="pengelola.transaksi.index" label="Data Transaksi" icon="wallet" />
      @endif
    </nav>
  </aside>

  {{-- MAIN CONTENT --}}
  <div class="flex-1 flex flex-col h-screen overflow-hidden">

    {{-- TOPBAR --}}
<header class="bg-white shadow px-6 py-4 flex justify-between items-center">
  <div class="flex items-center gap-4">
    {{-- Hamburger --}}
    <button @click="sidebarCollapsed = !sidebarCollapsed" class="focus:outline-none">
      <svg class="w-6 h-6 text-pine" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

    {{-- Judul / Breadcrumb --}}
    @php
    $judulDashboard = match(Auth::user()->role) {
        'admin' => 'Dashboard Admin',
        'pengelola' => 'Dashboard Pengelola',
        default => 'Dashboard'
    };
    @endphp

    <h1 class="text-lg font-semibold text-pine">@yield('title', $judulDashboard)</h1>
  </div>

    {{-- Action Icons --}}
    <div class="flex items-center gap-4">
    {{-- Notification Dropdown --}}
    @if(Auth::user()?->role === 'admin')
    <div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="relative w-10 h-10 bg-stone-100 rounded-full flex justify-center items-center">
        <i class="fas fa-bell text-pine"></i>
        <span class="absolute top-0 right-0 text-xs text-pine rounded-full px-1.5">{{ count($recentActivities ?? []) }}</span>
    </button>
    <div x-show="open" @click.outside="open = false" x-transition
        class="absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-lg z-50 overflow-hidden">
        <div class="p-4 border-b">
        <h6 class="font-semibold text-pine">Notifikasi</h6>
        </div>
        <div class="max-h-60 overflow-y-auto divide-y">
        @forelse($recentActivities ?? [] as $item)
            <div class="px-4 py-3 hover:bg-mist">
                <p class="text-sm font-medium text-gray-800">{{ $item['pesan'] }}</p>
                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item['waktu'])->diffForHumans() }}</p>
            </div>
        @empty
            <div class="px-4 py-3 text-sm text-gray-500">Belum ada aktivitas.</div>
        @endforelse
        </div>
        <div class="text-center p-2">
        <a href="{{ route('admin.aktivitas') }}" class="text-sm text-pine hover:underline">Lihat semua</a>
        </div>
    </div>
    </div>
    @endif

    @if(Auth::user()?->role === 'pengelola')
    <div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="relative w-10 h-10 bg-stone-100 rounded-full flex justify-center items-center">
        <i class="fas fa-bell text-pine"></i>
        <span class="absolute top-0 right-0 text-xs text-pine rounded-full px-1.5">{{ count($recentNotifikasi ?? []) }}</span>
    </button>
    <div x-show="open" @click.outside="open = false" x-transition
        class="absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-lg z-50 overflow-hidden">
        <div class="p-4 border-b">
        <h6 class="font-semibold text-pine">Notifikasi</h6>
        </div>
        <div class="max-h-60 overflow-y-auto divide-y">
        @forelse($recentNotifikasi ?? [] as $item)
            <div class="px-4 py-3 hover:bg-mist">
                <p class="text-sm font-medium text-gray-800">{{ $item['pesan'] }}</p>
                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item['waktu'])->diffForHumans() }}</p>
            </div>
        @empty
            <div class="px-4 py-3 text-sm text-gray-500">Belum ada notifikasi.</div>
        @endforelse
        </div>
    </div>
    </div>
    @endif

    {{-- Profile Dropdown --}}
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="w-10 h-10 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
            @if(Auth::user()->photo)
            <img src="{{ asset('storage/profile/' . Auth::user()->photo) }}" alt="Profile" class="w-full h-full object-cover" />
            @else
            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A4 4 0 017 16h10a4 4 0 011.879.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            @endif
        </button>

        <div x-show="open" @click.outside="open = false" x-transition
            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50 overflow-hidden">
            <div class="p-4 border-b">
            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
        </div>
        <ul class="text-sm">
          <li><a href="{{ route ('profile.edit') }}" class="block px-4 py-2 hover:bg-mist">Profil</a></li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-100 text-red-600">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
</header>



    {{-- PAGE CONTENT --}}
    <main class="flex-1 p-6 overflow-y-auto">
      @yield('content')
    </main>
    @stack('scripts')
  </div>
</body>
</html>

@push('scripts')
<script>
    window.tripEvents = @json($tripEvents ?? []);
</script>
@endpush
