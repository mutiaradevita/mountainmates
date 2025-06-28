<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" x-init="$watch('sidebarOpen', val => document.body.classList.toggle('overflow-hidden', val))">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body 
  class="bg-snow text-gray-800 min-h-screen flex"
  x-data="{
    sidebarOpen: JSON.parse(localStorage.getItem('sidebarOpen')) ?? true
  }"
  x-init="$watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', JSON.stringify(value)))"
>

  {{-- Sidebar --}}
  <aside
    x-show="sidebarOpen"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed z-40 inset-y-0 left-0 w-64 bg-pine text-snow transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static"
    @click.away="sidebarOpen = false"
    x-cloak
  >
    <div class="flex items-center gap-3 text-xl font-bold p-6 border-b border-moss">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain" />
      Mountain Mates
    </div>

    <nav class="p-4 space-y-2 text-sm">
      @if(Auth::user()?->role === 'admin')
        <x-nav-link route="admin.dashboard" label="Dashboard" />
        <x-nav-link route="admin.berita.index" label="Berita" />
        <x-nav-link route="admin.user.index" label="Kelola User" />
        <x-nav-link route="admin.trip.index" label="Data Trip" />
        <x-nav-link route="admin.transaksi.index" label="Data Transaksi" />
      @elseif(Auth::user()?->role === 'pengelola')
        <x-nav-link route="pengelola.dashboard" label="Dashboard" />
        <x-nav-link route="pengelola.trips.index" label="Kelola Trip" />
        <x-nav-link route="pengelola.trips.history" label="Riwayat" />
        <x-nav-link route="pengelola.trips.create" label="Tambah Trip" />
        <x-nav-link route="pengelola.transaksi.index" label="Data Transaksi" />
      @endif
    </nav>
  </aside>

  {{-- Overlay mobile --}}
  <div
    x-show="sidebarOpen && window.innerWidth < 1024"
    x-transition.opacity
    class="fixed inset-0 bg-black bg-opacity-50 z-30"
    @click="sidebarOpen = false"
    x-cloak
  ></div>

  {{-- Main Content --}}
  <div class="flex-1 flex flex-col min-h-screen">

    {{-- Topbar --}}
    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
      <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden">
        <svg class="w-6 h-6 text-pine" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
      <h1 class="text-lg font-semibold text-pine">@yield('title')</h1>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="text-sm bg-forest text-snow px-4 py-2 rounded hover:bg-pine transition">Logout</button>
      </form>
    </header>

    {{-- Page Content --}}
    <main class="flex-1 p-6 overflow-y-auto">
      @yield('content')
    </main>
  </div>

</body>
</html>
