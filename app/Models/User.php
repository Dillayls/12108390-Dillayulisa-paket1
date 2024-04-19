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

    protected $fillable = ['id', 'name', 'email', 'username', 'password', 'telepon', 'address', 'role', 'gambar'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $table = 'users';

    public function review()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function collection()
    {
        return $this->hasMany(Collection::class, 'user_id');
    }
}
