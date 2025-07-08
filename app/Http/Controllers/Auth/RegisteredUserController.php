<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required_if:role,peserta|string|max:255|nullable',
            'email' => 'required|string|lowercase|email|max:255|unique:users',
            'phone' => 'required|string',
            'password' => 'required|min:8',
            'role' => 'required|in:peserta,pengelola',
            'company_name' => 'required_if:role,pengelola|nullable|string|max:255',
            'pic_name' => 'required_if:role,pengelola|nullable|string|max:255',

        ]);

        $user = new User();
        $user->name = $request->role == 'peserta' ? $request->name : $request->company_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

        // Simpan company_name dan pic_name hanya jika role pengelola
        if ($request->role == 'pengelola') {
            $user->company_name = $request->company_name;
            $user->pic_name = $request->pic_name;
        } else {
            $user->company_name = null;
            $user->pic_name = null;
        }

        $user->save();

        if ($user->role === 'pengelola') {
            return redirect()->route('pengelola.dashboard');
        } else {
            return redirect()->route('login');
        }
    }
}
