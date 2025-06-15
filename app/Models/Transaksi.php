<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
     use HasFactory;

    // Relasi dengan pengguna (User)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan tiket (Trip)
    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'id_tiket');
    }
}
