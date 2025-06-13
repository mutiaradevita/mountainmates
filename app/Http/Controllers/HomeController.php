<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        }
        elseif ($usertype == 'pengelola') {
            return redirect()->route('pengelola.dashboard');
        }
        else {
            return view('home', ['user' => $user]); 
        }
        } else {
        return view('home', ['user' => null]);
        }
    }
  public function riwayat (){
        // $transaksi = Transaksi::all();
        // $event = Event::all();
        return view('riwayat');
    }
}
