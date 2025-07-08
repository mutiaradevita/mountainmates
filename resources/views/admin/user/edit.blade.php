@extends('layouts.dashboard')

@section('content')
<div class="bg-snow min-h-[calc(100vh-100px)] py-8 px-4">
  <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">

    <h1 class="text-xl font-bold mb-6">Edit User</h1>

    {{-- Avatar --}}
    <div class="flex flex-col items-center text-center mb-6">
      @if ($user->photo)
        <img src="{{ asset('storage/profile/' . $user->photo) }}" class="w-24 h-24 rounded-full shadow mb-4 object-cover" alt="Avatar">
      @else
        <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center shadow mb-4">
          <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.121 17.804A4 4 0 017 16h10a4 4 0 011.879.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
      @endif
      <div>
        <p class="font-semibold capitalize">{{ $user->name }}</p>
        <p class="text-xs text-gray-500 capitalize">{{ $user->role }}</p>
      </div>
    </div>

    <form method="POST" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
      @csrf @method('PUT')

      {{-- Pengelola --}}
      @if($user->role === 'pengelola')
        <div class="mb-4">
          <x-input-label for="company_name" value="Nama Perusahaan" />
          <x-text-input id="company_name" name="company_name" type="text" class="block mt-1 w-full"
            value="{{ old('company_name', $user->company_name) }}" />
          <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>

        <div class="mb-4">
          <x-input-label for="pic_name" value="Nama PIC" />
          <x-text-input id="pic_name" name="pic_name" type="text" class="block mt-1 w-full"
            value="{{ old('pic_name', $user->pic_name) }}" />
          <x-input-error :messages="$errors->get('pic_name')" class="mt-2" />
        </div>
      @else
        {{-- Peserta/Admin --}}
        <div class="mb-4">
          <x-input-label for="name" value="Nama Lengkap" />
          <x-text-input id="name" name="name" type="text" class="block mt-1 w-full"
            value="{{ old('name', $user->name) }}" required />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
      @endif

      {{-- Email --}}
      <div class="mb-4">
        <x-input-label for="email" value="Email" />
        <x-text-input id="email" name="email" type="email" class="block mt-1 w-full"
          value="{{ old('email', $user->email) }}" required />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      {{-- Phone (jangan tampilkan kalau admin) --}}
      @unless($user->role === 'admin')
      <div class="mb-4">
        <x-input-label for="phone" value="Nomor Telepon" />
        <x-text-input id="phone" name="phone" type="text" class="block mt-1 w-full"
          value="{{ old('phone', $user->phone) }}" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
      </div>
      @endunless

      {{-- Foto Profil --}}
      <div class="mb-6">
        <x-input-label for="photo" value="Foto Profil" />
        <input id="photo" name="photo" type="file" class="block mt-1 w-full text-sm text-gray-500
          file:mr-4 file:py-2 file:px-4
          file:rounded-md file:border-0
          file:text-sm file:font-semibold
          file:bg-moss/10 file:text-moss
          hover:file:bg-moss/20" accept="image/*">
        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
      </div>

      {{-- Tombol --}}
      <div class="flex justify-end gap-4">
        <a href="{{ route('admin.user.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</a>
        <button type="submit" class="px-4 py-2 bg-pine text-white rounded-md hover:bg-forest">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection
