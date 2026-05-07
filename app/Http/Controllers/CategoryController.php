<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * List categories
     */
    public function index()
    {
        $categories = Category::withCount('articles')
            ->latest()
            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Create form
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store category
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    /**
     * Show category with articles
     */
   
public function show($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    $articles = $category->articles()
        ->with(['author', 'category'])
        ->where('status', 'published')
        ->latest()
        ->paginate(10);

    return view('categories.show', compact('category', 'articles'));
}
    /**
     * Edit form
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update category
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Delete category
     */
    public function destroy(Category $category)
    {
        // Prevent deleting if articles exist
        if ($category->articles()->count() > 0) {
            return back()->with('error', 'Cannot delete category with articles');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}