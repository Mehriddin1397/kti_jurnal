<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\Journal;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::where('status', 'active')
            ->withCount('publishedArticles')
            ->get();

        return view('public.journals.index', compact('journals'));
    }

    public function show($slug)
    {
        $journal = Journal::where('slug', $slug)->firstOrFail();

        $articles = $journal->articles()
            ->where('status', 'published')
            ->with('authors')
            ->latest('published_at')
            ->paginate(20);

        $volumes = $journal->articles()
            ->where('status', 'published')
            ->select('volume', 'issue')
            ->distinct()
            ->orderByDesc('volume')
            ->orderByDesc('issue')
            ->get();

        $aboutPages = AboutPage::active()->ordered()->get();
        $aboutPagesData = $aboutPages->map(fn ($page) => [
            'slug' => $page->slug,
            'title_uz' => $page->title_uz,
            'title_en' => $page->title_en,
            'title_ru' => $page->title_ru,
            'description_uz' => $page->description_uz,
            'description_en' => $page->description_en,
            'description_ru' => $page->description_ru,
            'body_uz' => $page->body_uz,
            'body_en' => $page->body_en,
            'body_ru' => $page->body_ru,
        ])->values();

        return view('public.journals.show', compact('journal', 'articles', 'volumes', 'aboutPages', 'aboutPagesData'));
    }
}
