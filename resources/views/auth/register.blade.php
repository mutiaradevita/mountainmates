<x-guest-layout>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-4">
      <x-input-label for="role" :value="__('Role')"  />
      <select name="role" id="role" required class="block mt-1 w-full bg-white text-gray-800 placeholder-gray-500 dark:bg-white dark:text-gray-800 p-2 border rounded dark:border-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
        <option value="">Pilih Role</option>
        <option value="peserta" {{ old('role') == 'peserta' ? 'selected' : '' }}>Peserta</option>
        <option value="pengelola" {{ old('role') == 'pengelola' ? 'selected' : '' }}>Pengelola</option>
      </select>
      <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

     <!-- Fields for Peserta only -->
    <div id="peserta_fields" style="display: none;">
      <div class="mb-4">
        <x-input-label for="name" :value="__('Nama')" />
        <x-text-input id="name" spellcheck="false" class="block mt-1 w-full bg-white text-gray-800 placeholder-gray-500 dark:bg-white dark:text-gray-800" type="text" name="name" :value="old('name')" placeholder="Nama Lengkap" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>
    </div>

    <!-- Fields for Pengelola only -->
    <div id="pengelola_fields" style="display: none;">
      <div class="mb-4">
        <x-input-label for="company_name" :value="__('Nama Perusahaan')" />
        <x-text-input id="company_name" class="block mt-1 w-full bg-white text-gray-800 placeholder-gray-500 dark:bg-white dark:text-gray-800" type="text" name="company_name" :value="old('company_name')" placeholder="Nama Perusahaan" />
        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
      </div>

      <div class="mb-4">
        <x-input-label for="pic_name" :value="__('Nama PIC')" />
        <x-text-input id="pic_name" class="block mt-1 w-full bg-white text-gray-800 placeholder-gray-500 dark:bg-white dark:text-gray-800" type="text" name="pic_name" :value="old('pic_name')" placeholder="Nama PIC" />
        <x-input-error :messages="$errors->get('pic_name')" class="mt-2" />
      </div>
    </div>

    <div class="mb-4">
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="block mt-1 w-full bg-white text-gray-800 placeholder-gray-500 dark:bg-white dark:text-gray-800" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="mb-4">
      <x-input-label for="phone" :value="__('Nomor Telepon')" />
      <x-text-input id="phone" class="block mt-1 w-full bg-white text-gray-800 placeholder-gray-500 dark:bg-white dark:text-gray-800" type="text" name="phone" :value="old('phone')" required placeholder="Nomor Telepon" />
      <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>

    <div class="mb-4">
      <x-input-label for="password" :value="__('Password')" />
      <div class="relative">
      <x-text-input id="password" class="block mt-1 w-full bg-white text-gray-800 placeholder-gray-500 dark:bg-white dark:text-gray-800" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
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
      <a href="{{ route('login') }}" class="text-sm text-forest hover:underline">Sudah punya akun? Masuk disini</a>
    </div>

    <button type="submit" class="w-full bg-forest hover:bg-pine text-white font-semibold py-3 rounded-md">Daftar</button>
  </form>

  <p class="mt-8 text-xs text-center text-stone">Copyright © Mountain Mates {{ date('Y') }}</p>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var roleSelect = document.getElementById('role');
    var pengelolaFields = document.getElementById('pengelola_fields');
    var pesertaFields = document.getElementById('peserta_fields');
    var nameField = document.getElementById('name');

    function toggleFields(role) {
      if (role === 'pengelola') {
        pengelolaFields.style.display = 'block';
        pesertaFields.style.display = 'none';
        if (nameField) nameField.required = false;
      } else if (role === 'peserta') {
        pengelolaFields.style.display = 'none';
        pesertaFields.style.display = 'block';
        if (nameField) nameField.required = true;
      } else {
        pengelolaFields.style.display = 'none';
        pesertaFields.style.display = 'none';
        if (nameField) nameField.required = false;
      }
    }

    // Jalankan saat halaman pertama kali dimuat (untuk menangani old value)
    toggleFields(roleSelect.value);

    // Jalankan setiap kali user mengubah pilihan
    roleSelect.addEventListener('change', function () {
      toggleFields(this.value);
    });
  });
</script>
</x-guest-layout>
