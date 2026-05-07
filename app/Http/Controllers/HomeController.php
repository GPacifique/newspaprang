<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tender;
use App\Models\Announcement;
use App\Models\Advertisement;

class HomeController extends Controller
{
    public function index()
    {
        // =========================
        // FEATURED + HEADLINES
        // =========================
        $featured = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->latest()
            ->first();

        $breakingNews = Article::where('status', 'published')
            ->where('is_breaking', true)
            ->latest()
            ->take(10)
            ->get();

        $latestArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->latest()
            ->take(10)
            ->get();

        $trending = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(10)
            ->get();

        // =========================
        // CATEGORY HELPER
        // =========================
        $getCategory = function ($slug) {
            return Article::with(['category', 'author'])
                ->where('status', 'published')
                ->whereHas('category', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                })
                ->latest()
                ->take(8)
                ->get();
        };

        $entertainment = $getCategory('entertainment');
        $health = $getCategory('health');
        $education = $getCategory('education');
        $politics = $getCategory('politics');
        $sports = $getCategory('sports');
        $business = $getCategory('business');
        $technology = $getCategory('technology');

        // =========================
        // TENDERS
        // =========================
        $tenders = Tender::where('status', 'Active')
            ->latest()
            ->take(5)
            ->get();

        // =========================
        // ANNOUNCEMENTS
        // =========================
        $announcements = Announcement::where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        // =========================
        // ADS
        // =========================
        $advertisements = Advertisement::where('is_active', true)
            ->latest()
            ->take(5)
            ->get();

        return view('home', [
            'featured' => $featured,
            'breakingNews' => $breakingNews,
            'latestArticles' => $latestArticles,
            'trending' => $trending,

            'entertainment' => $entertainment,
            'health' => $health,
            'education' => $education,
            'politics' => $politics,
            'sports' => $sports,
            'business' => $business,
            'technology' => $technology,

            'tenders' => $tenders,
            'announcements' => $announcements,
            'advertisements' => $advertisements,
        ]);
    }
}