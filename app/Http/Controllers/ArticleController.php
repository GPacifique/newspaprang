<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ArticleController extends Controller
{
    /**
     * Display all published articles
     */
 // 1. Update the main public index method
public function index()
{
    return Inertia::render('guest/Articles/index', [
        'articles' => Article::all()
    ]);
}

// 2. Update the filtered byCategory method at the bottom of your controller
public function byCategory(Category $category)
{
    $articles = Article::with(['category', 'author'])
        ->where('category_id', $category->id)
        ->where('status', 'published')
        ->latest()
        ->paginate(12);

    return Inertia::render('guest/Articles/index', [
        'articles' => $articles,
        'category' => $category,
    ]);
}

    /**
     * Show single article
     */
    public function show(Article $article)
    {
        // increment views
        $article->increment('views');

        // load relationships
        $article->load(['category', 'author']);

        return Inertia::render('Articles/Show', [
            'article' => $article,
        ]);
    }

    /**
     * Show create article page
     */
    public function create()
    {
        return Inertia::render('Articles/Create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store article
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = null;

        /*
        |--------------------------------------------------------------------------
        | UPLOAD IMAGE TO PUBLIC/ARTICLES
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('featured_image')) {

            $image = $request->file('featured_image');

            $imageName = time() . '_' .
                Str::slug($request->title) . '.' .
                $image->getClientOriginalExtension();

            $image->move(public_path('articles'), $imageName);
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE ARTICLE
        |--------------------------------------------------------------------------
        */

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'featured_image' => $imageName,
            'status' => $request->status,
            'is_breaking' => $request->is_breaking ?? false,
            'views' => 0,
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Article created successfully.');
    }

    /**
     * Show edit page
     */
    public function edit(Article $article)
    {
        return Inertia::render('Articles/Edit', [
            'article' => $article,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update article
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = $article->featured_image;

        /*
        |--------------------------------------------------------------------------
        | UPDATE IMAGE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('featured_image')) {

            // delete old image
            if (
                $article->featured_image &&
                file_exists(public_path('articles/' . $article->featured_image))
            ) {
                unlink(public_path('articles/' . $article->featured_image));
            }

            $image = $request->file('featured_image');

            $imageName = time() . '_' .
                Str::slug($request->title) . '.' .
                $image->getClientOriginalExtension();

            $image->move(public_path('articles'), $imageName);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE ARTICLE
        |--------------------------------------------------------------------------
        */

        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'featured_image' => $imageName,
            'status' => $request->status,
            'is_breaking' => $request->is_breaking ?? false,
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Article updated successfully.');
    }

    /**
     * Delete article
     */
    public function destroy(Article $article)
    {
        /*
        |--------------------------------------------------------------------------
        | DELETE IMAGE
        |--------------------------------------------------------------------------
        */

        if (
            $article->featured_image &&
            file_exists(public_path('articles/' . $article->featured_image))
        ) {
            unlink(public_path('articles/' . $article->featured_image));
        }

        $article->delete();

        return redirect()
            ->back()
            ->with('success', 'Article deleted successfully.');
    }
    
}