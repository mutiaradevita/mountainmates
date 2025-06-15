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

    public function pengelola()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'trip_user', 'trip_id', 'user_id')
            ->withTimestamps();
    }
}
