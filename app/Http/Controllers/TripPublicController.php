<?php

namespace App\Http\Controllers;

use App\Models\Trip;

class TripPublicController extends Controller
{
    public function index()
    {
        $trips = Trip::where('status', 'aktif')->latest()->take(10)->get(); 

        return view('jelajah', compact('trips'));
    }

    public function show($id)
    {
        $trip = Trip::where('status', 'aktif')->findOrFail($id);
        return view('peserta.detail', compact('trip'));
    }
}

