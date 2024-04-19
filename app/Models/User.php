<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'nama_lengkap',
        'alamat',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function hasRole($roleName)
    {
        // Memeriksa apakah nilai kolom 'role' pada pengguna sama dengan $roleName
        return $this->role === $roleName;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function koleksipribadi()
    {
        return $this->hasMany(KoleksiPribadi::class);
    }

    public function buku()
    {
        return $this->belongsToMany(Buku::class, 'koleksipribadi');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class);
    }

    public function peminjamen()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
