<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conference;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ConferenceController extends Controller
{
    public function index(Request $request)
    {
        $query = Conference::query();
        if ($request->filled('search')) {
            $query->where('title_uz', 'LIKE', "%{$request->search}%");
        }
        $conferences = $query->latest()->paginate(20);
        return view('admin.conferences.index', compact('conferences'));
    }

    public function create()
    {
        $journals = Journal::where('status', 'active')->get();
        return view('admin.conferences.form', ['conference' => new Conference(), 'journals' => $journals]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_uz' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:conferences',
            'description_uz' => 'nullable|string',
            'description_en' => 'nullable|string',
            'venue' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'submission_deadline' => 'nullable|date',
            'registration_deadline' => 'nullable|date',
            'topics' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:30720',
            'status' => 'nullable|string',
            'proceedings_journal_id' => 'nullable|exists:journals,id',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_uz']);
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('conferences', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file'] = $request->file('pdf_file')->store('conferences/archives', 'public');
        }

        $validated['is_online'] = $request->boolean('is_online');

        Conference::create($validated);
        return redirect()->route('admin.conferences.index')->with('success', 'Konferensiya yaratildi.');
    }

    public function edit(Conference $conference)
    {
        $journals = Journal::where('status', 'active')->get();
        return view('admin.conferences.form', compact('conference', 'journals'));
    }

    public function update(Request $request, Conference $conference)
    {
        $validated = $request->validate([
            'title_uz' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:conferences,slug,' . $conference->id,
            'description_uz' => 'nullable|string',
            'description_en' => 'nullable|string',
            'venue' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'submission_deadline' => 'nullable|date',
            'registration_deadline' => 'nullable|date',
            'topics' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:30720',
            'status' => 'nullable|string',
            'proceedings_journal_id' => 'nullable|exists:journals,id',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($conference->cover_image)
                Storage::disk('public')->delete($conference->cover_image);
            $validated['cover_image'] = $request->file('cover_image')->store('conferences', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            if ($conference->pdf_file)
                Storage::disk('public')->delete($conference->pdf_file);
            $validated['pdf_file'] = $request->file('pdf_file')->store('conferences/archives', 'public');
        }

        $validated['is_online'] = $request->boolean('is_online');
        $conference->update($validated);
        return redirect()->route('admin.conferences.index')->with('success', 'Konferensiya yangilandi.');
    }

    public function destroy(Conference $conference)
    {
        if ($conference->cover_image)
            Storage::disk('public')->delete($conference->cover_image);
        if ($conference->pdf_file)
            Storage::disk('public')->delete($conference->pdf_file);

        $conference->delete();
        return redirect()->route('admin.conferences.index')->with('success', 'Konferensiya o\'chirildi.');
    }
}
