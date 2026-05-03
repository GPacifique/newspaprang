<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class EditorDashboardController extends Controller
{
    public function index()
    {
        return view('editor.dashboard', [
            'pendingArticles' => Article::where('status','submitted')->count(),

            'underReview' => Article::where('status','under_review')->count(),

            'recentSubmissions' => Article::with('author')
                ->where('status','submitted')
                ->latest()
                ->take(10)
                ->get(),

            'publishedToday' => Article::where('status','published')
                ->whereDate('created_at', today())
                ->count(),
        ]);
    }
}