<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Homepage / Newsroom Landing Page
     */
    public function index(Request $request)
    {
        // FIX: match frontend input name "q"
        $query = $request->input('q');

        /*
        |-----------------------------------------
        | FEATURED ARTICLE
        |-----------------------------------------
        */
        $featured = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->latest()
            ->first();

        /*
        |-----------------------------------------
        | BREAKING NEWS
        |-----------------------------------------
        */
        $breakingNews = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_breaking', true)
            ->latest()
            ->take(8)
            ->get();

        /*
        |-----------------------------------------
        | TRENDING ARTICLES
        |-----------------------------------------
        */
        $trending = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->orderByDesc('views')
            ->take(6)
            ->get();

        /*
        |-----------------------------------------
        | LATEST ARTICLES (WITH OPTIONAL SEARCH)
        |-----------------------------------------
        */
        $latestArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->when($query, function ($builder) use ($query) {
                $builder->where('title', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest()
            ->take(12)
            ->get();

        /*
        |-----------------------------------------
        | RETURN INERTIA PAGE
        |-----------------------------------------
        */
        return Inertia::render('Home', [
            'featured' => $featured,
            'breakingNews' => $breakingNews,
            'trending' => $trending,
            'latestArticles' => $latestArticles,
            'query' => $query ?? '',
        ]);
    }
}