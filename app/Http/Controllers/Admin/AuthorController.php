<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = Author::withCount('articles');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('first_name', 'LIKE', "%{$s}%")
                    ->orWhere('last_name', 'LIKE', "%{$s}%")
                    ->orWhere('email', 'LIKE', "%{$s}%");
            });
        }

        $authors = $query->latest()->paginate(20);
        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.form', ['author' => new Author()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'email' => 'nullable|email',
            'orcid' => 'nullable|string|max:25',
            'scopus_id' => 'nullable|string|max:50',
            'wos_id' => 'nullable|string|max:50',
            'organization' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('authors', 'public');
        }

        Author::create($validated);
        return redirect()->route('admin.authors.index')->with('success', 'Muallif qo\'shildi.');
    }

    public function edit(Author $author)
    {
        return view('admin.authors.form', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'email' => 'nullable|email',
            'orcid' => 'nullable|string|max:25',
            'scopus_id' => 'nullable|string|max:50',
            'wos_id' => 'nullable|string|max:50',
            'organization' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($author->photo)
                Storage::disk('public')->delete($author->photo);
            $validated['photo'] = $request->file('photo')->store('authors', 'public');
        }

        $author->update($validated);
        return redirect()->route('admin.authors.index')->with('success', 'Muallif yangilandi.');
    }

    public function destroy(Author $author)
    {
        if ($author->photo)
            Storage::disk('public')->delete($author->photo);
        $author->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Muallif o\'chirildi.');
    }
}
