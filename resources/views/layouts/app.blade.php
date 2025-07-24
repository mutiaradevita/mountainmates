<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mountain Mates</title> 

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>
<body class="min-h-screen flex flex-col bg-snow">

  {{-- Navbar --}}
  @include('components.navbar')

  {{-- Spacer untuk Navbar (karena fixed) --}}
  <div class="h-[80px]"></div>

  {{-- Main Content --}}
 <main class="flex-1 px-4 sm:px-6 md:px-8 lg:px-10 bg-snow">
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
