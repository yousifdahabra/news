<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'title',
        'content',
        'is_approved',
        'news_id',
        'path',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function news()
    {
        return $this->belongsTo(News::class);
    }

}
