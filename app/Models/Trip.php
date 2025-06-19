<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'nama_trip',
        'deskripsi_trip',
        'tanggal_trip',
        'flyer',
        'waktu',
        'lokasi',
        'tipe_trip',
        'jadwal_trip',
        'itinerary',
        'kuota',
        'harga',
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
        return $this->hasMany(Ulasan::class, 'user_id');
    }
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_trip');
    }
}
