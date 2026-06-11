<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Author;
use App\Models\Journal;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_articles' => Article::count(),
            'this_month_articles' => Article::whereMonth('created_at', now()->month)->count(),
            'total_journals' => Journal::count(),
            'active_journals' => Journal::where('status', 'active')->count(),
            'pending_submissions' => Submission::where('status', 'pending')->count(),
            'total_authors' => Author::count(),
        ];

        $recentArticles = Article::with('journal')
            ->latest()
            ->take(10)
            ->get();

        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyData[] = [
                'month' => $date->format('M'),
                'count' => Article::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        }

        return view('admin.dashboard', compact('stats', 'recentArticles', 'monthlyData'));
    }
}
