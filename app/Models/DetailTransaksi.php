<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'id_trip',
        'nama',
        'email',
        'nomor_telepon',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'id_trip');
    }
}

