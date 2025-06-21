@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah User (Peserta/Pengelola)</h1>

<form action="{{ route('admin.user.store') }}" method="POST" class="space-y-4 max-w-lg">
  @csrf
  <div>
    <label class="block mb-1">Role</label>
    <select name="role" class="w-full p-2 border rounded">
      <option value="">Pilih Role</option>
      <option value="peserta" {{ old('role') == 'peserta' ? 'selected' : '' }}>Peserta</option>
      <option value="pengelola" {{ old('role') == 'pengelola' ? 'selected' : '' }}>Pengelola</option>
    </select>
    @error('role') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
  </div>
  <div>
    <label class="block mb-1">Nama</label>
    <input type="text" name="name" class="w-full p-2 border rounded" value="{{ old('name') }}">
    @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
  </div>
  <div>
    <label class="block mb-1">Email</label>
    <input type="email" name="email" class="w-full p-2 border rounded" value="{{ old('email') }}">
    @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
  </div>
  <div>
    <label class="block mb-1">Password</label>
    <input type="password" name="password" class="w-full p-2 border rounded">
    @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
  </div>
  <div>
    <label class="block mb-1">Konfirmasi Password</label>
    <input type="password" name="password_confirmation" class="w-full p-2 border rounded">
  </div>
  <button type="submit" class="bg-pine text-snow px-4 py-2 rounded">Simpan</button>
</form>
@endsection
