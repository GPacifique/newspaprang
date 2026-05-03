<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article_image extends Model
{
    class ArticleImage extends Model
{
    protected $fillable = ['article_id','path'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
}
