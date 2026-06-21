<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'article_id',
        'parent_id',
        'name',
        'email',
        'content',
        'ip_address',
        'user_agent',
        'approved',
        'is_spam',
        'likes',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

public function user()
{
    return $this->belongsTo(User::class);
}
}