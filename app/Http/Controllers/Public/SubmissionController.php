<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use App\Models\Submission;
use App\Models\SubmissionAuthor;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function create()
    {
        $journals = Journal::where('status', 'active')->get();
        return view('public.submit.create', compact('journals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:500',
            'abstract' => 'nullable|string',
            'keywords' => 'nullable|string|max:500',
            'journal_id' => 'required|exists:journals,id',
            'article_type' => 'nullable|string',
            'language' => 'nullable|string',
            'pdf_file' => 'required|file|mimes:pdf,docx|max:5120',
            'plagiarism_file' => 'nullable|file|max:5120',
            'notes' => 'nullable|string',
            'authors' => 'required|array|min:1',
            'authors.*.first_name' => 'required|string|max:100',
            'authors.*.last_name' => 'required|string|max:100',
            'authors.*.organization' => 'nullable|string',
            'authors.*.email' => 'nullable|email',
            'authors.*.orcid' => 'nullable|string|max:25',
            'agreement' => 'accepted',
        ]);

        $pdfPath = $request->file('pdf_file')->store('submissions', 'public');
        $plagiarismPath = $request->hasFile('plagiarism_file')
            ? $request->file('plagiarism_file')->store('submissions/plagiarism', 'public')
            : null;

        $submission = Submission::create([
            'journal_id' => $validated['journal_id'],
            'title' => $validated['title'],
            'abstract' => $validated['abstract'] ?? null,
            'keywords' => $validated['keywords'] ?? null,
            'article_type' => $validated['article_type'] ?? null,
            'language' => $validated['language'] ?? null,
            'pdf_file' => $pdfPath,
            'plagiarism_file' => $plagiarismPath,
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        $correspondingIndex = $request->input('corresponding_author', 0);

        foreach ($validated['authors'] as $i => $authorData) {
            SubmissionAuthor::create([
                'submission_id' => $submission->id,
                'first_name' => $authorData['first_name'],
                'last_name' => $authorData['last_name'],
                'organization' => $authorData['organization'] ?? null,
                'email' => $authorData['email'] ?? null,
                'orcid' => $authorData['orcid'] ?? null,
                'is_corresponding' => $i == $correspondingIndex,
                'order' => $i + 1,
            ]);
        }

        return redirect()->route('submit.create')
            ->with('success', 'Maqolangiz muvaffaqiyatli yuborildi! Tez orada ko\'rib chiqamiz.');
    }
}
