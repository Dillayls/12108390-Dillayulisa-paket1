<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori_id',
        'cover',
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function koleksipribadi()
    {
        return $this->hasMany(KoleksiPribadi::class);
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
