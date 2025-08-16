<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    protected $table = 'dokumentasi';
    protected $fillable = ['id_trip', 'foto', 'keterangan'];

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'id_trip', 'id');
    }
}
