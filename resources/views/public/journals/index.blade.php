@extends('public.layouts.app')
@section('title', 'Jurnallar — Kriminologiya va Huquq')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="font-display text-3xl font-bold text-navy-dark mb-8">Jurnallar</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($journals as $journal)
        <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex gap-4">
                <div class="w-16 h-20 bg-navy-dark rounded-lg flex items-center justify-center text-white text-2xl flex-shrink-0">📰</div>
                <div class="flex-1">
                    <h2 class="font-semibold text-navy-dark text-lg">{{ $journal->name_uz }}</h2>
                    @if($journal->name_en)<p class="text-sm text-gray-400">{{ $journal->name_en }}</p>@endif
                    <div class="text-xs text-gray-500 mt-1">
                        @if($journal->issn_print)Print: {{ $journal->issn_print }} @endif
                        @if($journal->issn_online)· Online: {{ $journal->issn_online }}@endif
                    </div>
                    <p class="text-sm text-gray-600 mt-2 line-clamp-3">{{ $journal->description_uz }}</p>
                    <div class="flex flex-wrap gap-1 mt-3">
                        @if($journal->is_indexed_google_scholar)<span class="text-xs bg-green-50 text-green-700 px-2 py-0.5 rounded">Google Scholar</span>@endif
                        @if($journal->is_indexed_hak)<span class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded">OAK</span>@endif
                        @if($journal->is_indexed_scopus)<span class="text-xs bg-purple-50 text-purple-700 px-2 py-0.5 rounded">Scopus</span>@endif
                        @if($journal->is_indexed_inlibrary)<span class="text-xs bg-orange-50 text-orange-700 px-2 py-0.5 rounded">inLibrary</span>@endif
                    </div>
                    <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                        <span>📄 {{ $journal->published_articles_count }} maqola</span>
                        <span>📅 {{ ucfirst($journal->frequency) }}</span>
                    </div>
                    <a href="{{ route('journals.show', $journal->slug) }}" class="inline-block mt-3 text-sm text-gold font-medium hover:text-gold-light transition-colors">Ko'rish →</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
