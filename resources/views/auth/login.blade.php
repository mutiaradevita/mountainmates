<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full bg-white text-gray-800 placeholder-gray-500 dark:bg-white dark:text-gray-800" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
            <x-text-input id="password" class="block mt-1 w-full bg-white text-gray-800 placeholder-gray-500 dark:bg-white dark:text-gray-800" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
            <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-forest focus:outline-none">
                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </div>
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
