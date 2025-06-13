<!-- resources/views/layouts/guest.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Mountain Mates</title>
  @vite('resources/css/app.css')
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-mist">
  <div class="min-h-screen flex items-center justify-center px-4">
    <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 bg-snow shadow-lg rounded-xl overflow-hidden">
      
      <!-- Ilustrasi -->
      <div class="bg-pine flex items-center justify-center p-8">
        <img src="{{ asset('img/ilustrasi.png') }}" alt="Ilustrasi" class="w-full h-auto max-w-md">
      </div>

      <!-- Form Login -->
      <div class="flex flex-col justify-center px-8 py-12">
        <div class="flex flex-col items-center mb-8">
          <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-14 mb-4">
          <h2 class="text-xl font-semibold text-pine">Masuk</h2>
        </div>
        
        {{ $slot }}

      </div>

    </div>
  </div>
</body>
</html>
