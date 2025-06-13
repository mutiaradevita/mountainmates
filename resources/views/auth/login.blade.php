<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <x-input-label for="email" :value="__('Username/Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Username/Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-6 text-right">
            <a href="{{ route('password.request') }}" class="text-sm text-forest hover:underline">Lupa Password</a>
        </div>

        <button type="submit" class="w-full bg-forest hover:bg-pine text-white font-semibold py-3 rounded-md">Masuk</button>
    </form>

    <p class="mt-6 text-center text-sm text-stone">
          Belum punya akun? <a href="{{ route('register') }}" class="text-forest font-semibold hover:underline">DAFTAR DISINI</a>
    </p>

    <p class="mt-8 text-xs text-center text-stone">Copyright © Mountain Mates {{ date('Y') }}</p>
  </x-guest-layout>
