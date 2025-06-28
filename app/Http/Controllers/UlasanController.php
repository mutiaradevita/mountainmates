<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); 
        $ulasans = Ulasan::where('id_user', $userId)->with('trip')->get();

        return view('peserta.ulasan',compact('ulasans'));
    }

    public function create($trip_id)
    {
        $trip = Trip::findOrFail($trip_id);
        return view('peserta.ulasan.create', compact('trip'));
    }

    public function store(Request $request, $trip_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000',
        ]);

        Ulasan::create([
            'trip_id' => $trip_id,
            'peserta_id' => Auth::guard('peserta')->id(),
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('peserta.dashboard')->with('success', 'Ulasan berhasil dikirim!');
    }
}
