<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Homepage / Newsroom Landing Page
     */
    public function index(Request $request)
    {
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
        | LATEST ARTICLES (WITH OPTIONAL SEARCH)
        |-----------------------------------------
        | Wrapped the title/content search in a nested
        | where() so the OR doesn't escape the
        | status = 'published' constraint.
        */
        $latest = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->when($query, function ($builder) use ($query) {
                $builder->where(function ($inner) use ($query) {
                    $inner->where('title', 'like', "%{$query}%")
                          ->orWhere('content', 'like', "%{$query}%");
                });
            })
            ->latest()
            ->take(12)
            ->get();

        /*
        |-----------------------------------------
        | CATEGORIES
        |-----------------------------------------
        */
        $categories = Category::orderBy('name')->get();

        /*
        |-----------------------------------------
        | RETURN INERTIA PAGE
        |-----------------------------------------
        */
        return Inertia::render('Home', [
            'featured' => $featured,
            'latest' => $latest,
            'categories' => $categories,
            'query' => $query ?? '',
        ]);
    }
}