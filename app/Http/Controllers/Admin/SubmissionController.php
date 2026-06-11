<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Submission::with('journal', 'authors');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where('title', 'LIKE', "%{$request->search}%");
        }

        $submissions = $query->latest()->paginate(20);
        return view('admin.submissions.index', compact('submissions'));
    }

    public function show($id)
    {
        $submission = Submission::with('journal', 'authors')->findOrFail($id);
        return view('admin.submissions.show', compact('submission'));
    }

    public function updateStatus(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        $submission->update([
            'status' => $request->status,
            'reviewer_notes' => $request->reviewer_notes,
            'assigned_editor_id' => $request->assigned_editor_id,
        ]);

        return back()->with('success', 'Holat yangilandi.');
    }

    public function convertToArticle($id)
    {
        $submission = Submission::with('authors')->findOrFail($id);
        // Placeholder for conversion logic
        return back()->with('success', 'Maqolaga aylantirildi.');
    }
}
