<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    
    const ROLE_ADMIN  = 'ADMIN';
    const ROLE_EDITOR = 'EDITOR';
    const ROLE_USER   = 'USER';

    const ROLES = [
        self::ROLE_ADMIN => 'ADMIN',
        self::ROLE_EDITOR => 'EDITOR',
        self::ROLE_USER => 'USER'
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true; //$this->name === 'Ofordo' || $this->name === 'Antonio';
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isEditor()
    {
        return $this->role === self::ROLE_EDITOR;
    }

    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts() {
        return $this->belongsToMany(Post::class, 'post_user')
                    ->withPivot(['order'])
                    ->withTimestamps();
    }

    public function commentis() {
        return $this->morphMany(Commenti::class, 'commentabile');
    }

}
