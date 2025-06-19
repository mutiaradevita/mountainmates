<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Ulasan;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function landing()
    {
        $trips = Trip::all();
        $ulasans = Ulasan::latest()->with(['peserta.user', 'trip.pengelola'])->take(5)->get();
        $beritas = Berita::latest()->take(5)->get();

        return view('home', ['user' => null, 'trips' => $trips, 'ulasans' => $ulasans, 'beritas' => $beritas,]);
    }

    public function index()
    {
        $user = Auth::user(); 

        if ($user) {
            if ($user->usertype == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->usertype == 'pengelola') {
                return redirect()->route('pengelola.dashboard');
            } else {
                return redirect()->route('jelajah');
            }
        }

        return redirect()->route('landing'); 
    }

        public function riwayat (){
            // $transaksi = Transaksi::all();
            // $event = Event::all();
            return view('riwayat');
        }
}
