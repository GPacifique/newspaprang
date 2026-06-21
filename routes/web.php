<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;

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

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

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