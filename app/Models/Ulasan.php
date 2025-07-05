<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_trip',
        'id_transaksi',
        'komentar',
        'rating',
        'created_at',
        'updated_at',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'id_trip');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
