<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Show newsroom dashboard
     */
    public function index()
    {
        $user = auth()->user();

        // Global stats (newsroom overview)
        $stats = [
            'total_articles' => Article::count(),
            'published_articles' => Article::where('status', 'published')->count(),
            'drafts' => Article::where('status', 'draft')->count(),
            'total_views' => Article::sum('views'),
        ];

        // Latest articles (for table)
        $latestArticles = Article::with(['category', 'author'])
            ->latest()
            ->take(10)
            ->get();

        return Inertia::render('Dashboard', [
            'user' => $user,
            'stats' => $stats,
            'latestArticles' => $latestArticles,
        ]);
    }
}