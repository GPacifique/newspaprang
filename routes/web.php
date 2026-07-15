<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\SubscriberDashboardController;
use Inertia\Inertia;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthorDashboardController;
use App\Http\Controllers\EditorDashboardController;
use App\Http\Controllers\ModeratorDashboardController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\SuperAdminDashboardController;
Route::post('/articles/{article}/comments', [CommentController::class, 'store'])
    ->name('comments.store');

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy');


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| PUBLIC ARTICLES
|--------------------------------------------------------------------------
*/

// All articles
Route::get('/articles', [ArticleController::class, 'index'])
    ->name('articles.index');

// Articles by category (THIS FIXES YOUR Ziggy ISSUE)
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])
    ->name('categories.show');

// Single article (slug)
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])
    ->name('articles.show');

/*
|--------------------------------------------------------------------------
| Dashboards
|--------------------------------------------------------------------------
*/
// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardRedirectController::class)->name('dashboard');

    Route::get('/super-admin/dashboard', [SuperAdminDashboardController::class, 'index'])->name('super-admin.dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/editor/dashboard', [EditorDashboardController::class, 'index'])->name('editor.dashboard');
    Route::get('/author/dashboard', [AuthorDashboardController::class, 'index'])->name('author.dashboard');
    Route::get('/moderator/dashboard', [ModeratorDashboardController::class, 'index'])->name('moderator.dashboard');
    Route::get('/subscriber/dashboard', [SubscriberDashboardController::class, 'index'])->name('subscriber.dashboard');
    Route::get('/premium/dashboard', [PremiumDashboardController::class, 'index'])->name('premium.dashboard');


    // Save / unsave an article
    Route::post('/articles/{article}/bookmark', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/articles/{article}/bookmark', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});

/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/
Route::get('/search', [SearchController::class, 'index'])
    ->name('search');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| AUTHENTICATED AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ARTICLE MANAGEMENT (ADMIN)
    |--------------------------------------------------------------------------
    */

    Route::prefix('manage')->group(function () {

        Route::get('/articles/create', [ArticleController::class, 'create'])
            ->name('articles.create');

        Route::post('/articles', [ArticleController::class, 'store'])
            ->name('articles.store');

        Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])
            ->name('articles.edit');

        Route::put('/articles/{article}', [ArticleController::class, 'update'])
            ->name('articles.update');

        Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])
            ->name('articles.destroy');
    });
});