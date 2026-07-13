@extends('public.layouts.app')
@section('title', 'Maqolalar — Kriminologiya va Huquq')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="font-display text-3xl font-bold text-navy-dark mb-6">Maqolalar</h1>
        {{-- Filters --}}
        <div class="bg-white rounded-xl border p-5 mb-6">
            <form method="GET" class="flex flex-wrap gap-3">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Sarlavha, muallif, kalit so'z..."
                    class="flex-1 min-w-[200px] px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                <select name="journal_id" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">Barcha jurnallar</option>
                    @foreach($journals as $j)
                        <option value="{{ $j->id }}" {{ request('journal_id') == $j->id ? 'selected' : '' }}>{{ $j->name }}
                        </option>
                    @endforeach
                </select>
                <select name="year" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">Barcha yillar</option>
                    @foreach($years as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
                <select name="language" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">Barcha tillar</option>
                    @foreach(['uz' => 'O\'zbek', 'en' => 'English', 'ru' => 'Русский'] as $v => $l)
                        <option value="{{ $v }}" {{ request('language') === $v ? 'selected' : '' }}>{{ $l }}</option>
                    @endforeach
                </select>
                <button class="bg-navy text-white text-sm px-4 py-2 rounded-lg">Qidirish</button>
            </form>
        </div>

        {{-- Articles List --}}
        <div class="space-y-4">
            @forelse($articles as $article)
                <div class="bg-white rounded-xl border p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded">{{ $article->journal->name ?? '' }}</span>
                                <span class="text-xs text-gray-400">Tom {{ $article->volume }}, Son {{ $article->issue }}</span>
                                <span class="text-xs text-gray-400">{{ $article->published_at?->format('Y') }}</span>
                            </div>
                            <h2 class="text-lg font-semibold text-navy-dark mb-1">
                                <a href="{{ route('articles.show', $article->slug) }}"
                                    class="hover:text-gold transition-colors">
                                    {{ $article->title }}
                                </a>
                            </h2>
                            <p class="text-sm text-gray-500 mb-2">{{ $article->authors_string }}</p>
                            <p class="text-sm text-gray-600 line-clamp-3 mb-3">
                                {{ Str::limit($article->abstract, 250) }}</p>
                            <div class="flex flex-wrap items-center gap-3">
                                @if($article->doi)<span class="text-xs text-gray-500">DOI: {{ $article->doi }}</span>@endif
                                @if($article->pdf_file)
                                    <a href="{{ route('articles.pdf.view', $article->slug) }}" target="_blank"
                                        class="text-xs border border-navy text-navy px-2 py-1 rounded hover:bg-navy hover:text-white transition-colors">🔍
                                        Ko'rish</a>
                                    <a href="{{ route('articles.pdf', $article->slug) }}"
                                        class="text-xs border border-gold text-gold px-2 py-1 rounded hover:bg-gold hover:text-white transition-colors">📥
                                        PDF</a>
                                @endif
                                <a href="{{ route('articles.show', $article->slug) }}"
                                    class="text-xs text-navy font-medium hover:text-gold">Abstrakt →</a>
                                <span class="text-xs text-gray-400 ml-auto">👁 {{ $article->view_count }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-gray-400">Maqolalar topilmadi</div>
            @endforelse
        </div>
        <div class="mt-6">{{ $articles->appends(request()->query())->links() }}</div>
    </div>
@endsection