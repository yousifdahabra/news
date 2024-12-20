<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'is_approved',
        'age',
        'path',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
