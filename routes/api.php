<?php
use Illuminate\Support\Facades\Route;
use App\Models\Article;

Route::get('/home', function () {
    return [
        'latest_articles' => Article::where('status','published')->latest()->take(10)->get(),
        'trending' => Article::where('status','published')
            ->orderBy('views','desc')
            ->take(5)
            ->get(),
    ];
});