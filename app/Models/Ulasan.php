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
        'komentar',
        'created_at',
        'updated_at',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function pemberi()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pengelola()
    {
        return $this->belongsTo(User::class, 'id_pengelola');
    }

}
