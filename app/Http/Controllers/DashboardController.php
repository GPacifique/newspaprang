<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
         $articlesCount = Article::where('user_id', $user->id)->count();
         $publishedCount = Article::where('user_id', $user->id)->where('status', 'published')->count(); 
            $draftCount = Article::where('user_id', $user->id)->where('status', 'draft')->count();  
            $viewsCount = Article::where('user_id', $user->id)->sum('views');
$polics= Article::where('user_id', $user->id)->where('category_id', 1)->count();
$economy= Article::where('user_id', $user->id)->where('category_id', 2)->count();
$sports= Article::where('user_id', $user->id)->where('category_id', 3)->count();
$entertainment= Article::where('user_id', $user->id)->where('category_id', 4)->count();
$technology= Article::where('user_id', $user->id)->where('category_id', 5)->count();

        // Base query for this journalist
        $baseQuery = Article::where('user_id', $user->id);

            return view('dashboard', [
            'articlesCount' => $articlesCount,  
            'publishedCount' => $publishedCount,  
            'draftCount' => $draftCount,
            'viewsCount' => $viewsCount,
'polics' => $polics,
'economy' => $economy,
'sports' => $sports,
'entertainment' => $entertainment,
'technology' => $technology,
'totalArticles' => $articlesCount,

            // Latest 5 articles with category relationship
            'recentArticles' => (clone $baseQuery)
                ->with('category')
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }
}