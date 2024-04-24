<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koleksipribadi extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'buku_id',
    ];

    public function user()
    {
        //  setiap Koleksipribadi milik satu User
        return $this->belongsTo(User::class, 'user_id');
    }

    public function buku()
    {
        // setiap Koleksipribadi milik satu Buku
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
