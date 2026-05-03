<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JournalistDashboardController;
use App\Http\Controllers\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| ARTICLES (PUBLIC)
|------------------------------------------------------------------------

/*
IMPORTANT:
We use slug binding correctly here:
/articles/{article:slug}
*/
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])
    ->name('articles.show');

/*
|--------------------------------------------------------------------------
| CATEGORIES
|--------------------------------------------------------------------------
*/
Route::get('/category/{slug}', [CategoryController::class, 'show'])
    ->name('category.show');

/*
|--------------------------------------------------------------------------
| AUTH + ROLE PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

    /*
    -------------------------
    JOURNALIST DASHBOARD
    -------------------------
    */
    Route::middleware('role:journalist|editor|admin')->group(function () {

        Route::get('/journalist/dashboard', [JournalistDashboardController::class, 'index'])
            ->name('journalist.dashboard');


    /*
    -------------------------
    EDIT + DELETE (EDITOR / ADMIN ONLY)
    -------------------------
    /*
    -------------------------
    ADMIN DASHBOARD
    -------------------------
    */
    Route::middleware('role:admin')->group(function () {

        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');
    });

});