@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit User</h1>

<form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="space-y-4 max-w-lg">
  @csrf @method('PUT')
  <div>
    <label class="block mb-1">Nama</label>
    <input type="text" name="name" class="w-full p-2 border rounded" value="{{ old('name', $user->name) }}">
    @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
  </div>
  <div>
    <label class="block mb-1">Email</label>
    <input type="email" name="email" class="w-full p-2 border rounded" value="{{ old('email', $user->email) }}">
    @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
  </div>
  <button type="submit" class="bg-pine text-snow px-4 py-2 rounded">Update</button>
</form>
@endsection
