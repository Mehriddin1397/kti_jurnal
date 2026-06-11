<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $query = Journal::withCount('articles');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name_uz', 'LIKE', "%{$s}%")
                    ->orWhere('name_en', 'LIKE', "%{$s}%");
            });
        }

        $journals = $query->latest()->paginate(20);
        return view('admin.journals.index', compact('journals'));
    }

    public function create()
    {
        return view('admin.journals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_uz' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:journals',
            'issn_print' => 'nullable|string|max:20',
            'issn_online' => 'nullable|string|max:20',
            'description_uz' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'chief_editor' => 'nullable|string|max:255',
            'chief_editor_title' => 'nullable|string|max:255',
            'frequency' => 'nullable|string',
            'founding_year' => 'nullable|integer|min:1900|max:2100',
            'submission_email' => 'nullable|email',
            'status' => 'nullable|string',
            'aims_and_scope' => 'nullable|string',
            'peer_review_policy' => 'nullable|string',
            'author_guidelines' => 'nullable|string',
            'ethics_policy' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_uz']);
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('journals', 'public');
        }

        $validated['is_indexed_google_scholar'] = $request->boolean('is_indexed_google_scholar');
        $validated['is_indexed_hak'] = $request->boolean('is_indexed_hak');
        $validated['is_indexed_inlibrary'] = $request->boolean('is_indexed_inlibrary');
        $validated['is_indexed_scopus'] = $request->boolean('is_indexed_scopus');

        Journal::create($validated);

        return redirect()->route('admin.journals.index')->with('success', 'Jurnal muvaffaqiyatli yaratildi.');
    }

    public function edit(Journal $journal)
    {
        return view('admin.journals.edit', compact('journal'));
    }

    public function update(Request $request, Journal $journal)
    {
        $validated = $request->validate([
            'name_uz' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:journals,slug,' . $journal->id,
            'issn_print' => 'nullable|string|max:20',
            'issn_online' => 'nullable|string|max:20',
            'description_uz' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'chief_editor' => 'nullable|string|max:255',
            'chief_editor_title' => 'nullable|string|max:255',
            'frequency' => 'nullable|string',
            'founding_year' => 'nullable|integer|min:1900|max:2100',
            'submission_email' => 'nullable|email',
            'status' => 'nullable|string',
            'aims_and_scope' => 'nullable|string',
            'peer_review_policy' => 'nullable|string',
            'author_guidelines' => 'nullable|string',
            'ethics_policy' => 'nullable|string',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($journal->cover_image) {
                Storage::disk('public')->delete($journal->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('journals', 'public');
        }

        $validated['is_indexed_google_scholar'] = $request->boolean('is_indexed_google_scholar');
        $validated['is_indexed_hak'] = $request->boolean('is_indexed_hak');
        $validated['is_indexed_inlibrary'] = $request->boolean('is_indexed_inlibrary');
        $validated['is_indexed_scopus'] = $request->boolean('is_indexed_scopus');

        $journal->update($validated);

        return redirect()->route('admin.journals.index')->with('success', 'Jurnal yangilandi.');
    }

    public function destroy(Journal $journal)
    {
        if ($journal->cover_image) {
            Storage::disk('public')->delete($journal->cover_image);
        }
        $journal->delete();
        return redirect()->route('admin.journals.index')->with('success', 'Jurnal o\'chirildi.');
    }
}
