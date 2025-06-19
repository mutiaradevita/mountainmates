<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $guard = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'company_name',
        'pic_name',
        'email',
        'phone',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
     public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class);
    }
    public function ulasanMasuk()
    {
        return $this->hasMany(Ulasan::class, 'user_id');
    }
    public function ulasanTerkirim()
    {
        return $this->hasMany(Ulasan::class, 'peserta_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
