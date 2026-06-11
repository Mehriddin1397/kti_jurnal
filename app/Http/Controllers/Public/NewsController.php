<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()
            ->latest('published_at')
            ->paginate(12);

        return view('public.news.index', compact('news'));
    }

    public function show($slug)
    {
        $newsItem = News::where('slug', $slug)->firstOrFail();
        return view('public.news.show', compact('newsItem'));
    }

    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email|unique:subscribers,email']);

        DB::table('subscribers')->insert([
            'email' => $request->email,
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        return back()->with('subscribed', 'Obunaga muvaffaqiyatli yozildingiz!');
    }
}
