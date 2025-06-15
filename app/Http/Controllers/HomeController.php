<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user(); 

        if (Auth::check()) {
            $usertype = $user->usertype;

            if ($usertype == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($usertype == 'pengelola') {
                return redirect()->route('pengelola.dashboard');
            } else {
                $trips = Trip::all();
                return view('home', ['user' => $user, 'trips' => $trips]);
            }
        } else {
            $trips = Trip::all();
            return view('home', ['user' => null, 'trips' => $trips]);
        }
    }

    public function riwayat (){
        // $transaksi = Transaksi::all();
        // $event = Event::all();
        return view('riwayat');
    }
}
