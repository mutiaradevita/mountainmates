<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'nama_trip',
        'deskripsi_trip',
        'lokasi',
        'meeting_point',
        'kuota',
        'harga',
        'paket',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu',           
        'durasi',
        'sudah_termasuk',
        'belum_termasuk',
        'itinerary',
        'flyer',
        'status',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengelola()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'id_user');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_trip');
    }
}
