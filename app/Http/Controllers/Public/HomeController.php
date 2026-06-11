<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Conference;
use App\Models\Journal;
use App\Models\News;
use App\Models\Author;

class HomeController extends Controller
{
    public function index()
    {
        $latestArticles = Article::published()
            ->with('journal', 'authors')
            ->latest('published_at')
            ->take(4)
            ->get();

        $journals = Journal::where('status', 'active')->get();

        $conferences = Conference::whereIn('status', ['upcoming', 'active'])
            ->orderBy('start_date')
            ->take(3)
            ->get();

        $news = News::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $stats = [
            'articles' => Article::published()->count(),
            'journals' => Journal::where('status', 'active')->count(),
            'authors' => Author::count(),
            'citations' => Article::published()->sum('view_count'),
        ];

        return view('public.home', compact('latestArticles', 'journals', 'conferences', 'news', 'stats'));
    }
}
