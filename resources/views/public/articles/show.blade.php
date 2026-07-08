@extends('public.layouts.app')
@section('title', $article->title . ' — Kriminologiya')

@section('meta')
    {{-- Highwire Press format — Google Scholar --}}
    <meta name="citation_title" content="{{ $article->title }}">
    @foreach($article->authors as $author)
        <meta name="citation_author" content="{{ $author->last_name }}, {{ $author->first_name }}">
        <meta name="citation_author_institution" content="{{ $author->pivot->organization ?: $author->organization }}">
    @endforeach
    <meta name="citation_journal_title" content="{{ $article->journal->name }}">
    <meta name="citation_volume" content="{{ $article->volume }}">
    <meta name="citation_issue" content="{{ $article->issue }}">
    <meta name="citation_firstpage" content="{{ $article->page_from }}">
    <meta name="citation_lastpage" content="{{ $article->page_to }}">
    <meta name="citation_publication_date" content="{{ $article->published_at?->format('Y/m/d') }}">
    <meta name="citation_doi" content="{{ $article->doi }}">
    <meta name="citation_issn" content="{{ $article->journal->issn_online }}">
    <meta name="citation_language" content="{{ $article->language }}">
    @if($article->pdf_url)
        <meta name="citation_pdf_url" content="{{ $article->pdf_url }}">
    @endif
    <meta name="citation_abstract_html_url" content="{{ url()->current() }}">
    <meta name="citation_keywords" content="{{ $article->keywords }}">
    @if($article->is_open_access)
        <meta name="citation_fulltext_world_accessible" content="">
    @endif
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Main --}}
            <div class="lg:col-span-2">
                {{-- Breadcrumb --}}
                <div class="text-sm text-gray-500 mb-4">
                    <a href="{{ route('journals.show', $article->journal->slug) }}"
                        class="hover:text-navy">{{ $article->journal->name }}</a>
                    → Tom {{ $article->volume }}, Son {{ $article->issue }}
                </div>

                {{-- Title --}}
                <h1 class="font-display text-2xl md:text-3xl font-bold text-navy-dark leading-tight mb-4">
                    {{ $article->title }}
                </h1>

                {{-- Authors --}}
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($article->authors as $author)
                        <a href="{{ route('authors.show', $author->id) }}"
                            class="text-sm text-navy hover:text-gold font-medium">
                            {{ $author->full_name }}@if($author->pivot->is_corresponding)<sup>*</sup>@endif</a>@if(!$loop->last),@endif
                    @endforeach
                </div>

                {{-- Meta badges --}}
                <div class="flex flex-wrap gap-2 mb-6 text-xs text-gray-500">
                    @if($article->doi)<span class="bg-gray-100 px-2 py-1 rounded">DOI: <a
                        href="https://doi.org/{{ $article->doi }}" class="text-navy hover:text-gold"
                    target="_blank">{{ $article->doi }}</a></span>@endif
                    <span class="bg-gray-100 px-2 py-1 rounded">{{ $article->published_at?->format('d.m.Y') }}</span>
                    <span class="bg-gray-100 px-2 py-1 rounded">{{ ucfirst($article->article_type) }}</span>
                    <span class="bg-gray-100 px-2 py-1 rounded">{{ strtoupper($article->language) }}</span>
                    @if($article->is_open_access)<span class="bg-green-50 text-green-700 px-2 py-1 rounded">🔓 Open
                    Access</span>@endif
                    <span class="bg-gray-100 px-2 py-1 rounded">👁 {{ $article->view_count }} · 📥
                        {{ $article->download_count }}</span>
                </div>

                {{-- Abstract --}}
                <div class="bg-white rounded-xl border p-6 mb-6">
                    <h2 class="font-semibold text-navy-dark mb-3">Annotatsiya / Abstract</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $article->abstract }}</p>
                </div>

                {{-- Keywords --}}
                @if($article->keywords)
                    <div class="bg-white rounded-xl border p-6 mb-6">
                        <h2 class="font-semibold text-navy-dark mb-3">Kalit so'zlar / Keywords</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $article->keywords) as $kw)
                                <span class="bg-blue-50 text-blue-700 text-xs px-2 py-1 rounded">{{ trim($kw) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Full Text --}}
                @if($article->full_text_html)
                    <div class="bg-white rounded-xl border p-6 mb-6 prose max-w-none">
                        <h2 class="font-semibold text-navy-dark mb-3">To'liq matn</h2>
                        {!! $article->full_text_html !!}
                    </div>
                @endif

                {{-- References --}}
                @if($article->references)
                    <div class="bg-white rounded-xl border p-6 mb-6">
                        <h2>References</h2>
                        <div class="references text-sm text-gray-700 leading-relaxed space-y-1 mt-3">
                            {!! $article->references !!}
                        </div>
                    </div>
                @endif

                {{-- Cite Modal --}}
                <div class="bg-white rounded-xl border p-6" x-data="{ showCite: false }">
                    <button @click="showCite = !showCite"
                        class="bg-navy hover:bg-navy-dark text-white text-sm font-medium px-4 py-2 rounded-lg">📋 Iqtibos
                        keltirish</button>
                    @if($article->pdf_file)
                        <a href="{{ route('articles.pdf', $article->slug) }}"
                            class="ml-2 bg-gold hover:bg-gold-light text-white text-sm font-medium px-4 py-2 rounded-lg inline-block">📥
                            PDF yuklab olish</a>
                    @endif
                    <div x-show="showCite" x-transition class="mt-4 space-y-3">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 mb-1">APA</p>
                            <div class="bg-gray-50 text-xs p-3 rounded font-mono">{{ $article->authors_string }}
                                ({{ $article->published_at?->format('Y') }}).
                                {{ $article->title }}.
                                <em>{{ $article->journal->name }}</em>,
                                {{ $article->volume }}({{ $article->issue }}),
                                {{ $article->page_from }}–{{ $article->page_to }}. https://doi.org/{{ $article->doi }}
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 mb-1">Vancouver</p>
                            <div class="bg-gray-50 text-xs p-3 rounded font-mono">{{ $article->authors_string }}.
                                {{ $article->title }}.
                                {{ $article->journal->name }}.
                                {{ $article->published_at?->format('Y') }};{{ $article->volume }}({{ $article->issue }}):{{ $article->page_from }}-{{ $article->page_to }}.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Author Cards --}}
                <div class="bg-white rounded-xl border p-5">
                    <h3 class="font-semibold text-navy-dark mb-3">Mualliflar</h3>
                    @foreach($article->authors as $author)
                        <div class="py-3 {{ !$loop->last ? 'border-b' : '' }}">
                            <a href="{{ route('authors.show', $author->id) }}"
                                class="font-medium text-sm text-navy hover:text-gold">{{ $author->full_name }}</a>
                            @if($author->pivot->is_corresponding)<span class="text-xs text-gold">(asosiy)</span>@endif
                            <p class="text-xs text-gray-500 mt-0.5">{{ $author->pivot->organization ?: $author->organization }}
                            </p>
                            @if($author->orcid)
                            <p class="text-xs text-gray-400">ORCID: {{ $author->orcid }}</p>@endif
                        </div>
                    @endforeach
                </div>

                {{-- Related --}}
                @if($relatedArticles->count())
                    <div class="bg-white rounded-xl border p-5">
                        <h3 class="font-semibold text-navy-dark mb-3">O'xshash maqolalar</h3>
                        @foreach($relatedArticles as $rel)
                            <div class="py-2 {{ !$loop->last ? 'border-b' : '' }}">
                                <a href="{{ route('articles.show', $rel->slug) }}"
                                    class="text-sm text-navy hover:text-gold">{{ Str::limit($rel->title, 60) }}</a>
                                <p class="text-xs text-gray-400">{{ $rel->published_at?->format('Y') }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection