<x-home-layout>
  <div class="min-h-screen flex items-center justify-center px-4 pt-[100px] pb-12">
    <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 bg-mist shadow-lg rounded-xl overflow-hidden">
      
      <!-- Form Login -->
      <div class="flex flex-col justify-center px-8 py-12">
        <div class="flex flex-col items-center mb-8 -mt-4">
          <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-16 mb-4">
          <h2 class="text-xl font-semibold text-pine">Masuk</h2>
          <p class="text-sm text-stone">Sebagai Organizer</p>
        </div>
        
        <form method="POST" action="/login">
          @csrf
          <div class="mb-4">
            <input type="text" name="email" placeholder="Username/Email" class="w-full text-sm border border-stone rounded-md px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-forest">
          </div>
          <div class="mb-4">
            <input type="password" name="password" placeholder="Password" class="w-full text-sm border border-stone rounded-md px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-forest">
          </div>
          <div class="mb-6 text-right">
            <a href="/forgot-password" class="text-sm text-forest hover:underline">Lupa Password</a>
          </div>
          <button type="submit" class="w-full bg-forest hover:bg-pine text-white font-semibold py-3 rounded-md">Masuk</button>
        </form>

        <p class="mt-6 text-center text-sm text-stone">
          Belum punya akun? <a href="/register" class="text-forest font-semibold hover:underline">DAFTAR DISINI</a>
        </p>

        <p class="mt-8 text-xs text-center text-stone">Copyright © Mountain Mates {{ date('Y') }}</p>
      </div>

    </div>
  </div>
</x-home-layout>
