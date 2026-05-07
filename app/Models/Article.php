<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'author_id',
        'category_id',
        'approved_by',
        'status',
        'featured_image',
        'video_url',
        'is_featured',
        'is_breaking',
        'views',
        'published_at',
        'scheduled_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_breaking' => 'boolean',
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the article's image URL
     */
    

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }   
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
    public function scopeBreaking($query)
    {
        return $query->where('is_breaking', true);
    }   
    public function scopeTrending($query)
    {
        return $query->orderBy('views', 'desc');
    }
    public function scopeRecent($query)
    {
        return $query->latest();
    }
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
    public function scopeByAuthor($query, $authorId)
    {
        return $query->where('author_id', $authorId);
    }
    public function scopeSearch($query, $term)
    {
        return $query->where('title', 'like', "%{$term}%")
                     ->orWhere('content', 'like', "%{$term}%");
    }

    /**
     * Get the full URL for the featured image
     */
public function getImageUrlAttribute()
    {
        if (!$this->featured_image) {
            return null;
        }
        // If the path doesn't start with 'articles/', prepend it
        if (!str_starts_with($this->featured_image, 'articles/')) {
            return asset('storage/articles/' . $this->featured_image);
        }

        return asset('storage/' . $this->featured_image);
    }
}