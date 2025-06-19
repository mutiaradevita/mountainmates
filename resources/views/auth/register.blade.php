<x-guest-layout>
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-4">
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="mb-4">
      <x-input-label for="phone" :value="__('Nomor Telepon')" />
      <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required placeholder="Nomor Telepon" />
      <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>

    <div class="mb-4">
      <x-input-label for="password" :value="__('Password')" />
      <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="mb-4">
      <x-input-label for="role" :value="__('Role')"  />
      <select name="role" id="role" required class="block w-full mt-1  dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
        <option value="" disabled selected>Pilih Role</option>
        <option value="pendaki">Peserta</option>
        <option value="pengelola">Pengelola</option>
      </select>
      <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

    <!-- Fields for Pendaki only -->
    <div id="pendaki_fields" style="display: none;">
      <div class="mb-4">
        <x-input-label for="name" :value="__('Nama')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Nama Lengkap" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>
    </div>

    <!-- Fields for Pengelola only -->
    <div id="pengelola_fields" style="display: none;">
      <div class="mb-4">
        <x-input-label for="company_name" :value="__('Nama Perusahaan')" />
        <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" placeholder="Nama Perusahaan" />
        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
      </div>

      <div class="mb-4">
        <x-input-label for="pic_name" :value="__('Nama PIC')" />
        <x-text-input id="pic_name" class="block mt-1 w-full" type="text" name="pic_name" :value="old('pic_name')" placeholder="Nama PIC" />
        <x-input-error :messages="$errors->get('pic_name')" class="mt-2" />
      </div>
    </div>

    <div class="mb-6 text-right">
      <a href="{{ route('login') }}" class="text-sm text-forest hover:underline">Sudah punya akun? Masuk disini</a>
    </div>

    <button type="submit" class="w-full bg-forest hover:bg-pine text-white font-semibold py-3 rounded-md">Daftar</button>
  </form>

  <p class="mt-8 text-xs text-center text-stone">Copyright © Mountain Mates {{ date('Y') }}</p>

  <script>
    // Menampilkan atau menyembunyikan fields 'company_name', 'pic_name', dan 'name' berdasarkan role
    document.getElementById('role').addEventListener('change', function() {
      var pengelolaFields = document.getElementById('pengelola_fields');
      var pesertaFields = document.getElementById('peserta_fields');
      var nameField = document.getElementById('name');

      // Jika role pengelola, tampilkan pengelola fields dan sembunyikan pendaki fields
      if (this.value == 'pengelola') {
        pengelolaFields.style.display = 'block';
        pesertaFields.style.display = 'none';
        nameField.required = false; 
      } else if (this.value == 'peserta') {
        pengelolaFields.style.display = 'none';
        pesertaFields.style.display = 'block';
        nameField.required = true; 
      } else {
        pengelolaFields.style.display = 'none';
        pesertaFields.style.display = 'none';
      }
    });
  </script>
</x-guest-layout>
