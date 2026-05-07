<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category','author')
            ->latest()
            ->paginate(10);

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = null;

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')
                ->store('articles', 'public');
        }

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title).'-'.time(),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'author_id' => Auth::id(),
            'category_id' => $request->category_id,
            'status' => $request->status ?? 'draft',
            'featured_image' => $imagePath,
            'is_featured' => $request->has('is_featured'),
            'is_breaking' => $request->has('is_breaking'),
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return redirect()->route('articles.index')
            ->with('success','Article saved successfully');
    }

   public function show(Article $article)
{
    // Increment views count
    $article->increment('views');

    // Load relationships
    $article->load(['category', 'author']);

    // Related articles from same category
    $relatedArticles = Article::where('category_id', $article->category_id)
        ->where('id', '!=', $article->id)
        ->where('status', 'published')
        ->latest()
        ->take(5)
        ->get();

    return view('articles.show', compact(
        'article',
        'relatedArticles'
    ));
}

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('articles.edit', compact('article','categories'));
    }

    public function update(Request $request, Article $article)
    {
        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'is_featured' => $request->has('is_featured'),
            'is_breaking' => $request->has('is_breaking'),
        ]);

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return back();
    }

public function search(Request $request)
{
    $query = $request->q;

    $articles = Article::where('title', 'like', "%{$query}%")
        ->orWhere('content', 'like', "%{$query}%")
        ->published()
        ->latest()
        ->get();

    return view('articles.search', compact('articles', 'query'));
}
   
}
