<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * Fields that can be mass assigned
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'seo_title',
        'seo_description',
        'is_breaking',
        'is_featured',
        'views',
        'category_id',
        'user_id',
        'published_at',
    ];

    /**
     * Cast types
     */
    protected $casts = [
        'is_breaking' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Author of the article (journalist/user)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Category of article
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Comments under article
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    // Users who have saved (bookmarked) this article
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}