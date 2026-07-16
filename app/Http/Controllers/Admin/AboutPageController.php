<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AboutPageController extends Controller
{
    public function index(Request $request)
    {
        $query = AboutPage::with('journal')->ordered();

        if ($request->filled('journal_id')) {
            $query->forJournal($request->journal_id);
        }

        $pages = $query->get();
        $journals = Journal::orderBy('name_uz')->get();

        return view('admin.about-pages.index', compact('pages', 'journals'));
    }

    public function create()
    {
        $journals = Journal::orderBy('name_uz')->get();

        return view('admin.about-pages.create', compact('journals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'journal_id' => 'required|exists:journals,id',
            'slug' => [
                'required', 'string', 'max:255', 'alpha_dash',
                Rule::unique('about_pages')->where(fn ($q) => $q->where('journal_id', $request->journal_id)),
            ],
            'title_uz' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'description_uz' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'body_uz' => 'nullable|string',
            'body_en' => 'nullable|string',
            'body_ru' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        AboutPage::create($validated);

        return redirect()->route('admin.about-pages.index')->with('success', 'Sahifa yaratildi.');
    }

    public function edit(AboutPage $aboutPage)
    {
        $journals = Journal::orderBy('name_uz')->get();

        return view('admin.about-pages.edit', ['page' => $aboutPage, 'journals' => $journals]);
    }

    public function update(Request $request, AboutPage $aboutPage)
    {
        $validated = $request->validate([
            'journal_id' => 'required|exists:journals,id',
            'slug' => [
                'required', 'string', 'max:255', 'alpha_dash',
                Rule::unique('about_pages')->where(fn ($q) => $q->where('journal_id', $request->journal_id))->ignore($aboutPage->id),
            ],
            'title_uz' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'description_uz' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'body_uz' => 'nullable|string',
            'body_en' => 'nullable|string',
            'body_ru' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $aboutPage->update($validated);

        return redirect()->route('admin.about-pages.index')->with('success', 'Sahifa yangilandi.');
    }

    public function destroy(AboutPage $aboutPage)
    {
        $aboutPage->delete();

        return redirect()->route('admin.about-pages.index')->with('success', 'Sahifa o\'chirildi.');
    }
}
