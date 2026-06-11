<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Conference;

class ConferenceController extends Controller
{
    public function index()
    {
        $upcoming = Conference::whereIn('status', ['upcoming', 'active'])
            ->orderBy('start_date')
            ->get();

        $past = Conference::whereIn('status', ['closed', 'archived'])
            ->orderByDesc('start_date')
            ->get();

        return view('public.conferences.index', compact('upcoming', 'past'));
    }

    public function show($slug)
    {
        $conference = Conference::where('slug', $slug)->firstOrFail();
        return view('public.conferences.show', compact('conference'));
    }
}
