<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $primaryKey = 'id'; // Menentukan kunci utama

    protected $fillable = [
        'id',
        'nama_kategori'
    ];

    public function buku(){
        // hasMany() untuk menunjukkan bahwa satu kategori dapat memiliki banyak buku
        return $this->hasMany(Buku::class);
    }
}
