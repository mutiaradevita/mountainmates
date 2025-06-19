<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard')</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-snow text-stone">
  <div class="flex h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-pine text-snow flex flex-col shrink-0">
        <div class="flex items-center gap-3 text-xl font-bold p-6 border-b border-moss">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain" />
            Mountain Mates
        </div>
      <nav class="flex-1 p-4 space-y-2 text-sm">
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-pine">Dashboard</a>
            <a href="{{ route('admin.berita.index') }}" class="block px-4 py-2 rounded hover:bg-moss">Berita</a>
            <a href="{{ route('admin.user.index') }}" class="block px-4 py-2 rounded hover:bg-moss">Kelola User</a>
            <a href="{{ route('admin.trip.index') }}" class="block px-4 py-2 rounded hover:bg-moss">Data Trip</a>
            <a href="{{ route('admin.transaksi.index') }}" class="block px-4 py-2 rounded hover:bg-moss">Data Transaksi</a>

        @elseif(Auth::user()->role === 'pengelola')
            <a href="{{ route('pengelola.dashboard') }}" class="block px-4 py-2 rounded hover:bg-pine">Dashboard</a>
            <a href="{{ route('pengelola.trips.index') }}" class="block px-4 py-2 rounded hover:bg-pine">Kelola Trip</a>
            <a href="{{ route('pengelola.trips.history') }}" class="block px-4 py-2 rounded hover:bg-moss">Riwayat</a>
            <a href="{{ route('pengelola.trips.create') }}" class="block px-4 py-2 rounded hover:bg-moss">Tambah Trip</a>
        @endif
      </nav>
    </aside>

    {{-- Main Container --}}
    <div class="flex flex-col flex-1 min-h-screen overflow-hidden">

      {{-- Topbar --}}
      <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-pine">@yield('title')</h2>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="text-sm bg-forest text-snow px-4 py-2 rounded hover:bg-pine">Logout</button>
        </form>
      </header>

      {{-- Main Content --}}
      <main class="flex-1 p-6 overflow-y-auto">
        @yield('content')
      </main>

    </div>

  </div>
</body>
</html>
