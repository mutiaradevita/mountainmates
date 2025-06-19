<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    protected $fillable = [
        'judul', 
        'sumber', 
        'url', 
        'gambar', 
        'deskripsi'
    ];

    public function index()
    {
        $beritas = Berita::latest()->take(6)->get();
    
        return view('home', compact('berita', 'trips', 'ulasans'));
    }
}
