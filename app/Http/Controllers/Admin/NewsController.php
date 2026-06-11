<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();
        if ($request->filled('search')) {
            $query->where('title_uz', 'LIKE', "%{$request->search}%");
        }
        $news = $query->latest()->paginate(20);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.form', ['newsItem' => new News()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_uz' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news',
            'excerpt' => 'nullable|string',
            'body_uz' => 'nullable|string',
            'body_en' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
            'status' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_uz']);
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('news', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        News::create($validated);
        return redirect()->route('admin.news.index')->with('success', 'Yangilik yaratildi.');
    }

    public function edit(News $news)
    {
        return view('admin.news.form', ['newsItem' => $news]);
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title_uz' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news,slug,' . $news->id,
            'excerpt' => 'nullable|string',
            'body_uz' => 'nullable|string',
            'body_en' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
            'status' => 'nullable|string',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($news->cover_image)
                Storage::disk('public')->delete($news->cover_image);
            $validated['cover_image'] = $request->file('cover_image')->store('news', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $news->update($validated);
        return redirect()->route('admin.news.index')->with('success', 'Yangilik yangilandi.');
    }

    public function destroy(News $news)
    {
        if ($news->cover_image)
            Storage::disk('public')->delete($news->cover_image);
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Yangilik o\'chirildi.');
    }
}
