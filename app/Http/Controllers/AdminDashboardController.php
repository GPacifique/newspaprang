<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalArticles' => Article::count(),
            'publishedArticles' => Article::where('status', 'published')->count(),
            'draftArticles' => Article::where('status', 'draft')->count(),

            'latestArticles' => Article::latest()->take(5)->get(),

            'topAuthors' => User::withCount('articles')
                ->orderBy('articles_count', 'desc')
                ->take(5)
                ->get(),
        ]);
    }
}