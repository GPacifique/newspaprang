<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'username',
        'password',
        'profile_image',
        'bio',
        'role',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
   

public function articles()
{
    return $this->hasMany(Article::class);
}

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isEditor()
    {
        return $this->role === 'editor';
    }

    public function isJournalist()
    {
        return $this->role === 'journalist';
    }   
}