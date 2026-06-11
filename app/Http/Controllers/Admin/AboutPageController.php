<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function index()
    {
        $pages = AboutPage::ordered()->get();

        return view('admin.about-pages.index', compact('pages'));
    }

    public function edit(AboutPage $aboutPage)
    {
        return view('admin.about-pages.form', ['page' => $aboutPage]);
    }

    public function update(Request $request, AboutPage $aboutPage)
    {
        $validated = $request->validate([
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
}
