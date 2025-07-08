<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $pengelola = User::where('role', 'pengelola')->get();
        $peserta = User::where('role', 'peserta')->get();

        return view('admin.user.index', compact('pengelola', 'peserta'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $role = $request->input('role');

        $rules = [
            'role' => 'required|in:pengelola,peserta',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
        ];

        // Tambahkan validasi berdasarkan role
        if ($role === 'pengelola') {
            $rules['company_name'] = 'required|string|max:255';
            $rules['pic_name'] = 'required|string|max:255';
        } elseif ($role === 'peserta') {
            $rules['name'] = 'required|string|max:255';
        }

        $validated = $request->validate($rules);

        // Simpan user
        $user = User::create([
            'role' => $validated['role'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'name' => $role === 'peserta' ? $validated['name'] : $validated['company_name'],
            'company_name' => $role === 'pengelola' ? $validated['company_name'] : null,
            'pic_name'     => $role === 'pengelola' ? $validated['pic_name'] : null,
        ]);

        // Kalau pengelola, simpan info tambahan ke tabel terpisah (kalau ada), atau pakai field JSON / kolom tambahan di tabel users

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan!');
}

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect()->route('admin.user.index')->with('success', 'User dihapus.');
    }
}
