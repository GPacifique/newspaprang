<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Show category page (React/Inertia)
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $articles = Article::with(['author', 'category'])
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(10);

        return Inertia::render('Categories/Show', [
            'category' => $category,
            'articles' => $articles,
        ]);
    }

    /**
     * Optional: list all categories
     */
    public function index()
    {
        $categories = Category::withCount('articles')->get();

        return Inertia::render('Categories/Index', [
            'categories' => $categories,
        ]);
    }
}