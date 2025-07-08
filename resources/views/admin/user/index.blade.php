@extends('layouts.dashboard')

@section('content')
<h1 class="text-center text-2xl font-bold mb-6">Kelola User (Peserta & Pengelola)</h1>

<a href="{{ route('admin.user.create') }}" class="bg-pine text-snow px-4 py-2 rounded mb-4 inline-block">+ Tambah User</a>

@if(session('success'))
  <div class="bg-emerald-100 text-emerald-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<div class="mb-8">
  <h2 class="font-semibold mb-2">Pengelola</h2>
  <table class="w-full table-auto text-sm bg-white rounded shadow">
    <thead class="bg-mist">
      <tr>
        <th class="px-4 py-2">Nama Perusahaan</th>
        <th class="px-4 py-2">Nama PIC</th>
        <th class="px-4 py-2">Email</th>
        <th class="px-4 py-2">Nomor Telepon</th>
        <th class="px-4 py-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pengelola as $user)
      <tr class="border-t">
        <td class="text-center px-4 py-2">{{ $user->company_name }}</td>
        <td class="text-center px-4 py-2">{{ $user->pic_name }}</td>
        <td class="text-center px-4 py-2">{{ $user->email }}</td>
        <td class="text-center px-4 py-2">{{ $user->phone }}</td>
        <td class="text-center px-6 py-4 flex space-x-2">
          <a href="{{ route('admin.user.edit', $user->id) }}" class="bg-sunset text-white px-3 py-1 rounded-lg hover:bg-orange-400 transition">Edit</a>
          <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button onclick="return confirm('Yakin hapus?')" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div>
  <h2 class="font-semibold mb-2">Peserta</h2>
  <table class="w-full table-auto text-sm bg-white rounded shadow">
    <thead class="bg-mist">
      <tr>
        <th class="text-center px-4 py-2">Nama</th>
        <th class="text-center px-4 py-2">Email</th>
        <th class="text-center px-4 py-2">Nomor Telepon</th>
        <th class="text-center px-4 py-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($peserta as $user)
      <tr class="border-t">
        <td class="text-center px-4 py-2">{{ $user->name }}</td>
        <td class="text-center px-4 py-2">{{ $user->email }}</td> 
        <td class="text-center px-4 py-2">{{ $user->phone }}</td>
        <td class="text-center px-6 py-4 flex space-x-2">
          <a href="{{ route('admin.user.edit', $user->id) }}" class="bg-sunset text-white px-3 py-1 rounded-lg hover:bg-orange-400 transition">Edit</a>
          <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button onclick="return confirm('Yakin hapus?')" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
