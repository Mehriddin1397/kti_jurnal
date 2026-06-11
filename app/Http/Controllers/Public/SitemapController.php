<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $articles = Article::published()
            ->select('slug', 'updated_at')
            ->get();

        $content = view('public.sitemap', compact('articles'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
