<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'books_id', 'review', 'rating'];

    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $table = 'review';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function books()
    {
        return $this->belongsTo(Books::class, 'books_id');
    }
}
