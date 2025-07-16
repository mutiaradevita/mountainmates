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

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eye-icon');

        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.944-9.543-7a9.966 9.966 0 012.38-4.246m3.234-2.408A9.958 9.958 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.973 9.973 0 01-1.357 2.572M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3l18 18" />
            `;
        } else {
            input.type = 'password';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }
    }
</script>

