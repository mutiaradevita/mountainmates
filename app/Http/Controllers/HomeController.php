<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $users = Auth::user();

        // Data dummy dulu buat card
        $filteredCards = [
            [
                'id' => 1,
                'title' => 'Open Trip Bromo',
                'location' => 'Malang, Jawa Timur',
                'description' => 'Nikmati sunrise dari puncak Penanjakan.',
                'price' => 350000,
                'reviews' => 124,
                'rating' => 4.8,
                'image' => 'https://source.unsplash.com/featured/?mountain',
                'ratingIcon' => 'https://upload.wikimedia.org/wikipedia/commons/4/44/Plain_Yellow_Star.png',
            ],
        ];

        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'admin') {
                return redirect()->route('dashboard');
            } else {
                return view('home', compact('users', 'filteredCards'));
            }
        } else {
            return view('home', compact('users', 'filteredCards'));
        }
    }
}
