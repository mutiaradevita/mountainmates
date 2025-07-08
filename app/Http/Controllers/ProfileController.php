<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

       if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '_', $file->getClientOriginalName());

            // Simpan langsung ke public/storage/profile
            $file->move(public_path('storage/profile'), $filename);

            // Hapus foto lama jika ada
            if ($user->photo && file_exists(public_path('storage/profile/' . $user->photo))) {
                unlink(public_path('storage/profile/' . $user->photo));
            }

            $user->photo = $filename;
        }

        $user->fill($request->except('photo'));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($user->role === 'pengelola') {
            if (empty($request->company_name) || empty($request->pic_name)) {
                return back()->withErrors([
                    'company_name' => 'Nama perusahaan wajib diisi.',
                    'pic_name' => 'Nama PIC wajib diisi.',
                ]);
            }
        }

        $user->save();


        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Profil berhasil diperbarui.');
        } elseif (Auth::user()->role === 'pengelola') {
            return redirect()->route('pengelola.dashboard')->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()->route('home')->with('success', 'Profil berhasil diperbarui.');
        }
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/home');
    }
}
