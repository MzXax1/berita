<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'user_id',
        'comment',
        'slug'
    ];

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    // Optionally, if you have an Article model and want to define a relationship
    public function article()
    {
        return $this->belongsTo(Article::class, 'slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
