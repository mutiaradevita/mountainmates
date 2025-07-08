<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaTransaksi extends Model
{
    protected $fillable = [
        'id_transaksi',
        'id_trip', 
        'nama', 
        'nomor_telepon', 
        'email'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'id_trip');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

