<?php

use Illuminate\Support\Facades\Route;

// ═══════════════════════════════════════
// PUBLIC ROUTES
// ═══════════════════════════════════════
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['uz', 'en', 'ru'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', [App\Http\Controllers\Public\HomeController::class, 'index'])->name('home');

Route::prefix('journals')->name('journals.')->group(function () {
    Route::get('/', [App\Http\Controllers\Public\JournalController::class, 'index'])->name('index');
    Route::get('/{slug}', [App\Http\Controllers\Public\JournalController::class, 'show'])->name('show');
});

Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [App\Http\Controllers\Public\ArticleController::class, 'index'])->name('index');
    Route::get('/{slug}', [App\Http\Controllers\Public\ArticleController::class, 'show'])->name('show');
    Route::get('/{slug}/pdf', [App\Http\Controllers\Public\ArticleController::class, 'downloadPdf'])->name('pdf');
    Route::get('/{slug}/pdf/view', [App\Http\Controllers\Public\ArticleController::class, 'viewPdf'])->name('pdf.view');
});

Route::get('/authors/{id}', [App\Http\Controllers\Public\AuthorController::class, 'show'])->name('authors.show');

Route::prefix('conferences')->name('conferences.')->group(function () {
    Route::get('/', [App\Http\Controllers\Public\ConferenceController::class, 'index'])->name('index');
    Route::get('/{slug}', [App\Http\Controllers\Public\ConferenceController::class, 'show'])->name('show');
});

Route::get('/submit', [App\Http\Controllers\Public\SubmissionController::class, 'create'])->name('submit.create');
Route::post('/submit', [App\Http\Controllers\Public\SubmissionController::class, 'store'])->name('submit.store');

Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [App\Http\Controllers\Public\NewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [App\Http\Controllers\Public\NewsController::class, 'show'])->name('show');
});

Route::get('/sitemap.xml', [App\Http\Controllers\Public\SitemapController::class, 'index'])->name('sitemap');
Route::post('/subscribe', [App\Http\Controllers\Public\NewsController::class, 'subscribe'])->name('subscribe');

// ═══════════════════════════════════════
// AUTH ROUTES (simple login/logout)
// ═══════════════════════════════════════
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ═══════════════════════════════════════
// ADMIN ROUTES
// ═══════════════════════════════════════
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('journals', App\Http\Controllers\Admin\JournalController::class);
    Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class);
    Route::resource('authors', App\Http\Controllers\Admin\AuthorController::class);
    Route::resource('conferences', App\Http\Controllers\Admin\ConferenceController::class);
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::resource('about-pages', App\Http\Controllers\Admin\AboutPageController::class)->except(['show']);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

    // Submissions
    Route::get('submissions', [App\Http\Controllers\Admin\SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('submissions/{id}', [App\Http\Controllers\Admin\SubmissionController::class, 'show'])->name('submissions.show');
    Route::patch('submissions/{id}/status', [App\Http\Controllers\Admin\SubmissionController::class, 'updateStatus'])->name('submissions.status');
    Route::post('submissions/{id}/convert', [App\Http\Controllers\Admin\SubmissionController::class, 'convertToArticle'])->name('submissions.convert');

    // Settings
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});
