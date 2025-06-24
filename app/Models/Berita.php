<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'beritas';
    protected $fillable = [
        'judul', 
        'sumber', 
        'url', 
        'gambar', 
        'deskripsi'
    ];

    public function index()
    {
        $berita = Berita::latest()->take(6)->get();
    
        return view('home', compact('berita', 'trips', 'ulasans'));
    }
}
