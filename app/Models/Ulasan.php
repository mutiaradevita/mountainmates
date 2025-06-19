<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'peserta_id',
        'rating',
        'komentar',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function peserta()
    {
        return $this->belongsTo(User::class, 'peserta_id');
    }

    public function pengelola()
    {
        return $this->belongsTo(User::class, 'pengelola_id');
    }
}
