<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'name',
        'slug',
    ];

    public function post() {
        return $this->hasMany(post::class);
    }

    public function commentis() {
        return $this->morphMany(Commenti::class, 'commentabile');
    }
}
