<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Author;

class AuthorController extends Controller
{
    public function show($id)
    {
        $author = Author::findOrFail($id);
        $articles = $author->articles()
            ->where('status', 'published')
            ->with('journal')
            ->latest('published_at')
            ->paginate(20);

        return view('public.authors.show', compact('author', 'articles'));
    }
}
