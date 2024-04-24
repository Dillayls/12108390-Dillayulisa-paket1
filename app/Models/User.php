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
        'nama',
        'username',
        'email',
        'password',
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

    public function buku(){
        // hasMany() untuk menunjukkan bahwa satu kategori dapat memiliki banyak buku
        return $this->hasMany(Buku::class, 'user_id');
    }

    public function koleksipribadis()
    {
        return $this->hasMany(Koleksipribadi::class);
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }

    public function peminjamen()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
