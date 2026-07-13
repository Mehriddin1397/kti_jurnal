<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::published()
            ->with('journal', 'authors')
            ->filter($request->all())
            ->latest('published_at')
            ->paginate(15);

        $journals = Journal::where('status', 'active')->get();

        $years = Article::published()
            ->whereNotNull('published_at')
            ->pluck('published_at')
            ->map(fn($date) => $date->format('Y'))
            ->unique()
            ->sortDesc()
            ->values();

        return view('public.articles.index', compact('articles', 'journals', 'years'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->with(['journal', 'authors'])
            ->firstOrFail();

        $article->increment('view_count');

        $relatedArticles = Article::published()
            ->where('journal_id', $article->journal_id)
            ->where('id', '!=', $article->id)
            ->with('authors')
            ->take(5)
            ->get();

        return view('public.articles.show', compact('article', 'relatedArticles'));
    }

    public function downloadPdf($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        if (!$article->pdf_file) {
            abort(404);
        }

        $article->increment('download_count');

        return Storage::disk('public')->download($article->pdf_file);
    }

    public function viewPdf($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        if (!$article->pdf_file) {
            abort(404);
        }

        $article->increment('view_count');

        return Storage::disk('public')->response($article->pdf_file);
    }
}
