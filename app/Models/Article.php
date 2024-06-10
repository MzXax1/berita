<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories_id','user_id', 'title', 'slug', 'desc', 'img', 'status', 'views', 'publish_date'
    ];

    //relasi ke categories

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
