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
}