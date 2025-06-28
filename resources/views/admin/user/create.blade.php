@extends('layouts.dashboard')

@section('title', 'Tambah User')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
  <h1 class="text-2xl font-bold">Tambah User</h1>

  <form method="POST" action="{{ route('admin.user.store') }}" class="space-y-4">
    @csrf

    {{-- Role --}}
    <div>
      <x-input-label for="role" :value="'Role'" />
      <select name="role" id="role" class="block w-full border rounded p-2">
        <option value="">Pilih Role</option>
        <option value="peserta" {{ old('role') == 'peserta' ? 'selected' : '' }}>Peserta</option>
        <option value="pengelola" {{ old('role') == 'pengelola' ? 'selected' : '' }}>Pengelola</option>
      </select>
      <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

    {{-- Peserta Fields --}}
    <div id="peserta_fields" style="display: none;">
      <div>
        <x-input-label for="name" :value="'Nama Lengkap'" />
        <x-text-input id="name" type="text" name="name" class="block w-full" :value="old('name')" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>
    </div>

    {{-- Pengelola Fields --}}
    <div id="pengelola_fields" style="display: none;">
      <div>
        <x-input-label for="company_name" :value="'Nama Perusahaan'" />
        <x-text-input id="company_name" type="text" name="company_name" class="block w-full" :value="old('company_name')" />
        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
      </div>

      <div>
        <x-input-label for="pic_name" :value="'Nama PIC'" />
        <x-text-input id="pic_name" type="text" name="pic_name" class="block w-full" :value="old('pic_name')" />
        <x-input-error :messages="$errors->get('pic_name')" class="mt-2" />
      </div>
    </div>

    {{-- Email --}}
    <div>
      <x-input-label for="email" :value="'Email'" />
      <x-text-input id="email" type="email" name="email" class="block w-full" :value="old('email')" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    {{-- Nomor Telepon --}}
    <div>
      <x-input-label for="phone" :value="'Nomor Telepon'" />
      <x-text-input id="phone" type="text" name="phone" class="block w-full" :value="old('phone')" />
      <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>

    {{-- Password --}}
    <div>
      <x-input-label for="password" :value="'Password'" />
      <x-text-input id="password" type="password" name="password" class="block w-full" />
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    {{-- Konfirmasi Password --}}
    <div>
      <x-input-label for="password_confirmation" :value="'Konfirmasi Password'" />
      <x-text-input id="password_confirmation" type="password" name="password_confirmation" class="block w-full" />
    </div>

    <button type="submit" class="bg-pine hover:bg-forest text-white font-semibold px-4 py-2 rounded">
      Simpan
    </button>
  </form>
</div>

{{-- Script toggle --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role');
    const pengelolaFields = document.getElementById('pengelola_fields');
    const pesertaFields = document.getElementById('peserta_fields');
    const nameField = document.getElementById('name');

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
      }
    }

    toggleFields(roleSelect.value);
    roleSelect.addEventListener('change', function () {
      toggleFields(this.value);
    });
  });
</script>
@endsection
