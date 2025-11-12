<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commenti extends Model
{

    use HasFactory;

        protected $fillable = [
        'user_id',
        'commento',
        'commentabile_id',
        'commentabile_type',
    ];

   public function commentabile() {
    return $this->morphTo();
   } 

   public function user() {
    return $this->belongsTo(User::class);
   }

}
