<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Article;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * A category has many articles
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function getRouteKeyName()
{
    return 'slug';
}
}