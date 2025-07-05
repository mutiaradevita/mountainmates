<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
     use HasFactory;

    protected $fillable = [
            'id_user',
            'id_trip',
            'jumlah_peserta',
            'total',
            'total_dp',
            'total_pelunasan',
            'status',
            'status_pembayaran',
            'nama',
            'nomor_telepon',
            'email',
            'catatan_khusus',
            'paket',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function trip() 
    {
        return $this->belongsTo(Trip::class, 'id_trip');
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'id_transaksi');
    }

   public function peserta()
    {
        return $this->hasMany(PesertaTransaksi::class, 'id_transaksi');
    }
}
