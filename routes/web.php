<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\JournalistDashboardController;
Use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
Use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactMessageController;
Use App\Http\Controllers\AnalyticsController;

/*
|--------------------------------------------------------------------------
| HOME PAGE
|----------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/', [HomeController::class, 'index'])->name('welcome'); --- IGNORE ---
//Route::get('/', [HomeController::class, 'index'])->name('welcome');

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT (ROLE BASED)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {

    $user = auth()->user();

    return match ($user?->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'editor' => redirect()->route('editor.dashboard'),
        'journalist' => redirect()->route('journalist.dashboard'),
        default => redirect('/'),
    };

})->middleware('auth')->name('dashboard');
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/editor/dashboard', function () {
        return view('editor.dashboard');
    })->name('editor.dashboard');

    Route::get('/journalist/dashboard', function () {
        return view('journalist.dashboard');
    })->name('journalist.dashboard');

});
/*
|--------------------------------------------------------------------------
| AUTH PROTECTED PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');
});
//analytics
Route::get('/analytics', [AnalyticsController::class, 'index'])
    ->name('analytics.index')
    ->middleware('auth');
//User routes
Route::get('/users/create', [UserController::class, 'create'])
    ->name('users.create');
Route::post('/users', [UserController::class, 'store'])
    ->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])
    ->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->name('users.destroy');
 Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');
//comments
Route::get('/comments', function () {
    return 'Comments Management';
})->name('comments.index')->middleware('auth');
//media
Route::get('/media', function () {
    return 'Media Library';
})->name('media.index')->middleware('auth');
//ads
Route::get('/ads', function () {
    return 'Ads Management';
})->name('ads.index')->middleware('auth');
//announcements
Route::get('/announcements', function () {
    return 'Announcements Management';
})->name('announcements.index')->middleware('auth');
//Roles and Permissions
Route::get('/roles', function () {
    return 'Roles Management';
})->name('roles.index')->middleware('auth');
//settings
Route::get('/settings', function () {
    return 'Settings';
})->name('settings.index')->middleware('auth');
//analytics
Route::get('/analytics', function () {
    return 'Analytics Dashboard';
})->name('analytics.index')->middleware('auth');
//messages
Route::get('/messages', function () {
    return 'Messages';
})->name('messages.index')->middleware('auth');
//notifications
Route::get('/notifications', function () {
    return 'Notifications';
})->name('notifications.index')->middleware('auth');
//backup
Route::get('/backup', function () {
    return 'Backup Management';
})->name('backup.index')->middleware('auth');
//logs
Route::get('/logs', function () {
    return 'System Logs';
})->name('logs.index')->middleware('auth');
//

Route::middleware(['auth'])->group(function () {
Route::resource('categories', CategoryController::class);
    // list all articles
    Route::get('/articles', [ArticleController::class, 'index'])
        ->name('articles.index');
        Route::get('/search', [ArticleController::class, 'search'])
    ->name('articles.search');

    // create form
    Route::get('/articles/create', [ArticleController::class, 'create'])
        ->name('articles.create');
//edit form
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])
        ->name('articles.edit');
        //destroy article
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])
        ->name('articles.destroy');
    // store article
    Route::post('/articles', [ArticleController::class, 'store'])
        ->name('articles.store');
}
);

/*
|--------------------------------------------------------------------------
| PUBLIC CONTENT ROUTES (NEWS)
|--------------------------------------------------------------------------
*/
//articles
Route::get('/articles.create',[ArticleController::class,'create'])
    ->name('articles.create');

// Articles (slug)
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])
    ->name('articles.show');

// Categories (slug)
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])
    ->name('categories.show');

// Announcements
Route::get('/announcements/{announcement:slug}', [AnnouncementController::class, 'show'])
    ->name('announcements.show');
/*
|--------------------------------------------------------------------------
| TENDER ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/tenders', [TenderController::class, 'index'])->name('tenders.index');

Route::get('/tenders/create', [TenderController::class, 'create'])->name('tenders.create');

Route::post('/tenders', [TenderController::class, 'store'])->name('tenders.store');

Route::get('/tenders/search', [TenderController::class, 'search'])->name('tenders.search');

Route::get('/tenders/{tender}', [TenderController::class, 'show'])->name('tenders.show');
/*
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| EDITOR DASHBOARD
|-------------------------------------------------------------------------

/*
-----------------------------------------------------------------------
|
|contact
*/
Route::view('/contact', 'contact')->name('contact');
Route::get('/contact', [ContactMessageController::class, 'index'])->name('contact');
Route::post('/contact', [ContactMessageController::class, 'send'])->name('contact.send');
/*
|--------------------------------------------------------------------------
| LANGUAGE SWITCHER
|--------------------------------------------------------------------------
*/
Route::get('/language/{locale}', function ($locale) {

    if (in_array($locale, ['en', 'fr', 'rw', 'sw'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();

})->name('language.switch');
//system admin
Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/system', fn () => 'System Panel');
});
Route::middleware(['auth', 'role:admin|editor'])->group(function () {
    Route::get('/articles/create', fn () => 'Create Article');
});
Route::middleware(['auth', 'role:moderator'])->group(function () {
    Route::get('/review', fn () => 'Review Articles');
});
/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze / Jetstream)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';