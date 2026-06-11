<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Author;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('journal', 'authors');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('title_uz', 'LIKE', "%{$s}%")
                    ->orWhere('title_en', 'LIKE', "%{$s}%");
            });
        }
        if ($request->filled('journal_id')) {
            $query->where('journal_id', $request->journal_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $articles = $query->latest()->paginate(20);
        $journals = Journal::where('status', 'active')->get();

        return view('admin.articles.index', compact('articles', 'journals'));
    }

    public function create()
    {
        $journals = Journal::where('status', 'active')->get();
        $authors = Author::orderBy('last_name')->get();
        return view('admin.articles.create', compact('journals', 'authors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_uz' => 'required|string|max:500',
            'title_en' => 'nullable|string|max:500',
            'title_ru' => 'nullable|string|max:500',
            'slug' => 'nullable|string|max:500|unique:articles',
            'journal_id' => 'required|exists:journals,id',
            'volume' => 'nullable|integer',
            'issue' => 'nullable|integer',
            'page_from' => 'nullable|integer',
            'page_to' => 'nullable|integer',
            'published_at' => 'nullable|date',
            'abstract_uz' => 'nullable|string',
            'abstract_en' => 'nullable|string',
            'abstract_ru' => 'nullable|string',
            'keywords_uz' => 'nullable|string|max:500',
            'keywords_en' => 'nullable|string|max:500',
            'keywords_ru' => 'nullable|string|max:500',
            'doi' => 'nullable|string|max:255',
            'language' => 'nullable|string',
            'article_type' => 'nullable|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5120',
            'full_text_html' => 'nullable|string',
            'references' => 'nullable|string',
            'status' => 'nullable|string',
            'received_at' => 'nullable|date',
            'accepted_at' => 'nullable|date',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_uz'] ?: $validated['title_en']);
        }

        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file'] = $request->file('pdf_file')->store('articles', 'public');
        }

        $validated['is_open_access'] = $request->boolean('is_open_access');

        $article = Article::create($validated);

        // Attach authors
        if ($request->has('author_ids')) {
            foreach ($request->author_ids as $i => $authorId) {
                $article->authors()->attach($authorId, [
                    'order' => $i + 1,
                    'is_corresponding' => $request->input('corresponding_author') == $authorId,
                    'organization' => $request->input("author_orgs.{$i}"),
                ]);
            }
        }

        return redirect()->route('admin.articles.index')->with('success', 'Maqola yaratildi.');
    }

    public function edit(Article $article)
    {
        $article->load('authors');
        $journals = Journal::where('status', 'active')->get();
        $allAuthors = Author::orderBy('last_name')->get();
        return view('admin.articles.edit', compact('article', 'journals', 'allAuthors'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title_uz' => 'required|string|max:500',
            'title_en' => 'nullable|string|max:500',
            'title_ru' => 'nullable|string|max:500',
            'slug' => 'nullable|string|max:500|unique:articles,slug,' . $article->id,
            'journal_id' => 'required|exists:journals,id',
            'volume' => 'nullable|integer',
            'issue' => 'nullable|integer',
            'page_from' => 'nullable|integer',
            'page_to' => 'nullable|integer',
            'published_at' => 'nullable|date',
            'abstract_uz' => 'nullable|string',
            'abstract_en' => 'nullable|string',
            'abstract_ru' => 'nullable|string',
            'keywords_uz' => 'nullable|string|max:500',
            'keywords_en' => 'nullable|string|max:500',
            'keywords_ru' => 'nullable|string|max:500',
            'doi' => 'nullable|string|max:255',
            'language' => 'nullable|string',
            'article_type' => 'nullable|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5120',
            'full_text_html' => 'nullable|string',
            'references' => 'nullable|string',
            'status' => 'nullable|string',
            'received_at' => 'nullable|date',
            'accepted_at' => 'nullable|date',
        ]);

        if ($request->hasFile('pdf_file')) {
            if ($article->pdf_file) {
                Storage::disk('public')->delete($article->pdf_file);
            }
            $validated['pdf_file'] = $request->file('pdf_file')->store('articles', 'public');
        }

        $validated['is_open_access'] = $request->boolean('is_open_access');
        $article->update($validated);

        // Sync authors
        $article->authors()->detach();
        if ($request->has('author_ids')) {
            foreach ($request->author_ids as $i => $authorId) {
                $article->authors()->attach($authorId, [
                    'order' => $i + 1,
                    'is_corresponding' => $request->input('corresponding_author') == $authorId,
                    'organization' => $request->input("author_orgs.{$i}"),
                ]);
            }
        }

        return redirect()->route('admin.articles.index')->with('success', 'Maqola yangilandi.');
    }

    public function destroy(Article $article)
    {
        if ($article->pdf_file) {
            Storage::disk('public')->delete($article->pdf_file);
        }
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Maqola o\'chirildi.');
    }
}
