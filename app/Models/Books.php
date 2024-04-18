<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'author', 'cover', 'publisher', 'publication_year', 'decsription', 'stok', 'category_id'];

    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $table = 'books';

    public function getRouteKeyName()
    {

    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function review()
    {
        return $this->hasMany(Ulasan::class, 'books_id');
    }

    public function collection()
    {
        return $this->hasMany(Koleksi::class, 'books_id');
    }
}
