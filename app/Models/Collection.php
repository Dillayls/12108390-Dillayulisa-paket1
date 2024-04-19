<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'books_id'];

    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $table = 'collection';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function books()
    {
        return $this->belongsTo(Books::class, 'books_id');
    }
}
