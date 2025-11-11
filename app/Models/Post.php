<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'thumbnail',
        'title',
        'color',
        'slug',
        'content',
        'tags',
        'published',
        'category_id',
        'published',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }


    
    public function autori() {
        return $this->belongsToMany(User::class, 'post_user')
                    ->withPivot(['order'])
                    ->withTimestamps();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

