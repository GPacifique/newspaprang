<?php
namespace App\Http\Controllers;

use App\Models\Article;


class JournalistDashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();
    $submittedCount = $user->articles()->where('status', 'submitted')->count();
    $underReviewCount = $user->articles()->where('status', 'under_review')->count();
    $publishedCount = $user->articles()->where('status', 'published')->count(); 
    $draftCount = $user->articles()->where('status', 'draft')->count();
    $rejectedCount = $user->articles()->where('status', 'rejected')->count();
    $viewsCount = $user->articles()->sum('views');

    return view('journalist.dashboard', [
        'submitted' => $user->articles()->where('status','submitted')->count(),
        'underReview' => $user->articles()->where('status','under_review')->count(),
        'published' => $user->articles()->where('status','published')->count(),
        'drafts' => $user->articles()->where('status','draft')->count(),
'rejected' => $user->articles()->where('status','rejected')->count(),
'totalViews' => $user->articles()->sum('views'),
'recentArticles' => $user->articles()
            ->with('category')
            ->latest()
            ->limit(5)
            ->get(),
            'articlesCount' => $user->articles()->count(),
            'publishedCount' => $user->articles()->where('status', 'published')->count(),
            'draftCount' => $user->articles()->where('status', 'draft')->count(),
            'viewsCount' => $user->articles()->sum('views'),
        'myArticles' => $user->articles()
            ->latest()
            ->take(10)
            ->get(),
    ]);
}
}