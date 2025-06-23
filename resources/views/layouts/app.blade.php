<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script type="text/javascript" src="{{ config('midtrans.snap_url') }}"
  data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body class="bg-gray-100 text-gray-800" x-data="{ sidebarOpen: true }">
  <div class="flex flex-col min-h-screen lg:ml-64">

    {{-- Sidebar --}}
    <aside 
      x-cloak
      :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
      class="fixed z-30 inset-y-0 left-0 w-64 bg-pine text-snow transform transition-transform duration-300 ease-in-out lg:static lg:translate-x-0"
    >
      <div class="flex items-center gap-3 text-xl font-bold p-6 border-b border-moss">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain" />
        Mountain Mates
      </div>

      <nav class="p-4 space-y-2 text-sm">
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-moss">Dashboard</a>
        <a href="{{ route('admin.berita.index') }}" class="block px-4 py-2 rounded hover:bg-moss">Berita</a>
        <a href="{{ route('admin.user.index') }}" class="block px-4 py-2 rounded hover:bg-moss">Kelola User</a>
        <a href="{{ route('admin.trip.index') }}" class="block px-4 py-2 rounded hover:bg-moss">Data Trip</a>
        <a href="{{ route('admin.transaksi.index') }}" class="block px-4 py-2 rounded hover:bg-moss">Data Transaksi</a>
        @elseif(Auth::user()->role === 'pengelola')
        <a href="{{ route('pengelola.dashboard') }}" class="block px-4 py-2 rounded hover:bg-moss">Dashboard</a>
        <a href="{{ route('pengelola.trips.index') }}" class="block px-4 py-2 rounded hover:bg-moss">Kelola Trip</a>
        <a href="{{ route('pengelola.trips.history') }}" class="block px-4 py-2 rounded hover:bg-moss">Riwayat</a>
        <a href="{{ route('pengelola.trips.create') }}" class="block px-4 py-2 rounded hover:bg-moss">Tambah Trip</a>
        @endif
      </nav>
    </aside>

       {{-- Overlay di mobile --}}
    <div 
      x-show="sidebarOpen && window.innerWidth < 1024" 
      x-transition.opacity 
      class="fixed inset-0 bg-black bg-opacity-50 z-20" 
      @click="sidebarOpen = false"
    ></div>

    {{-- Main --}}
    <div class="flex flex-col flex-1 transition-all duration-300 ease-in-out">

      {{-- Header --}}
      <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <button @click="sidebarOpen = !sidebarOpen">
          <svg class="w-6 h-6 text-pine" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
        <h2 class="text-lg font-semibold text-pine">@yield('title')</h2>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="text-sm bg-forest text-snow px-4 py-2 rounded hover:bg-pine">Logout</button>
        </form>
      </header>

      {{-- Content --}}
      <main class="flex-1 p-6 overflow-y-auto">
        @yield('content')
      </main>

    </div>
  </div>
</body>
</html>
