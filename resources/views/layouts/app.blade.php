<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Mountain Mates')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-gray-800 min-h-screen flex flex-col">

  {{-- Navbar --}}
  @include('components.navbar')

  {{-- Spacer untuk Navbar (karena fixed) --}}
  <div class="h-[80px]"></div>

  {{-- Main Content --}}
  <main class="flex-1 px-4 py-10 bg-snow">
    <div class="max-w-5xl mx-auto">
      @hasSection('title')
        <h1 class="text-2xl font-semibold text-pine mb-6">@yield('title')</h1>
      @endif

      @yield('content')
    </div>
  </main>

  {{-- Footer --}}
  @include('components.footer')

</body>
</html>
