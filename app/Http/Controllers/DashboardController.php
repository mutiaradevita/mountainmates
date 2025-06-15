<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\TripUser;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     return view('admin.dashboard');
    // }

     public function indexAdmin()
    {
        return view('dashboard'); 
    }
    
    public function index()
    {
        $pengelolaId = Auth::id();

        $activeTripsCount = Trip::where('created_by', $pengelolaId)->where('status', 'aktif')->count();
        $completedTripsCount = Trip::where('created_by', $pengelolaId)->where('status', 'selesai')->count();
        $participantsCount = TripUser::whereHas('trip', function($query) use ($pengelolaId) {
            $query->where('created_by', $pengelolaId);
        })->count();

        $latestTrips = Trip::where('created_by', $pengelolaId)
            ->latest()
            ->take(5)
            ->get();

        return view('pengelola.dashboard', compact('activeTripsCount', 'completedTripsCount', 'participantsCount', 'latestTrips'));
    }
}
