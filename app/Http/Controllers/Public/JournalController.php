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

        $publishedArticles = $journal->articles()
            ->where('status', 'published')
            ->with('authors')
            ->latest('published_at')
            ->get();

        $issues = $publishedArticles
            ->groupBy(fn ($article) => $article->volume . '-' . $article->issue)
            ->map(function ($group, $key) {
                $first = $group->first();

                return [
                    'key' => $key,
                    'volume' => $first->volume,
                    'issue' => $first->issue,
                    'latest_published_at' => optional($group->max('published_at'))->format('Y-m-d'),
                    'articles' => $group->map(fn ($article) => [
                        'slug' => $article->slug,
                        'title' => $article->title,
                        'authors' => $article->authors_string,
                        'year' => $article->published_at?->format('Y'),
                    ])->values(),
                ];
            })
            ->sortByDesc('latest_published_at')
            ->values();

        $defaultIssueKey = $issues->first()['key'] ?? null;

        $aboutPages = AboutPage::forJournal($journal->id)->active()->ordered()->get();
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

        return view('public.journals.show', compact('journal', 'issues', 'defaultIssueKey', 'aboutPages', 'aboutPagesData'));
    }
}
