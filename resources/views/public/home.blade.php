@extends('public.layouts.app')
@section('title', 'Bosh sahifa — Kriminologiya va Huquq Ilmiy Jurnali')

@section('content')
    {{-- Hero --}}
    <section class="bg-navy-dark text-white">
        <div class="max-w-7xl mx-auto px-4 py-16 md:py-24">
            <div class="max-w-3xl">
                <p class="text-gold-light text-sm font-medium tracking-wider uppercase mb-3">O'zbekiston Ilmiy Jurnali</p>
                <h1 class="font-display text-4xl md:text-5xl font-bold leading-tight mb-4">
                    Kriminologiya va Huquq
                </h1>
                <p class="text-blue-200 text-lg leading-relaxed mb-8">
                    Kriminologiya, jinoyat huquqi va huquqbuzarlikning oldini olish sohasidagi ilmiy tadqiqot natijalarini
                    nashr etuvchi etakchi jurnal.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('submit.create') }}"
                        class="bg-gold hover:bg-gold-light text-white font-semibold px-6 py-3 rounded-lg transition-colors inline-flex items-center gap-2">
                        📝 Maqola yuborish
                    </a>
                    <a href="{{ route('articles.index') }}"
                        class="border border-blue-300 text-blue-200 hover:bg-navy-light px-6 py-3 rounded-lg transition-colors">
                        Maqolalar arxivi →
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <p class="text-3xl font-bold text-navy">{{ $stats['articles'] }}+</p>
                    <p class="text-sm text-gray-500">Maqolalar</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-navy">{{ $stats['journals'] }}</p>
                    <p class="text-sm text-gray-500">Jurnallar</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-navy">{{ $stats['authors'] }}+</p>
                    <p class="text-sm text-gray-500">Mualliflar</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-navy">{{ number_format($stats['citations']) }}</p>
                    <p class="text-sm text-gray-500">Ko'rishlar</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Latest Articles --}}
    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex items-center justify-between mb-8">
            <h2 class="font-display text-2xl font-bold text-navy-dark">So'nggi maqolalar</h2>
            <a href="{{ route('articles.index') }}" class="text-sm text-gold hover:text-gold-light font-medium">Barchasi
                →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($latestArticles as $article)
                <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-2 mb-3">
                        <span
                            class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded">{{ $article->journal->name ?? '' }}</span>
                        <span class="text-xs text-gray-400">{{ $article->published_at?->format('Y') }}</span>
                    </div>
                    <h3 class="font-semibold text-navy-dark text-sm leading-snug mb-2">
                        <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-gold transition-colors">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <p class="text-xs text-gray-500 mb-2">{{ $article->authors_string }}</p>
                    <p class="text-xs text-gray-600 leading-relaxed line-clamp-3 mb-3">
                        {{ Str::limit($article->abstract, 150) }}
                    </p>
                    <div class="flex items-center gap-3">
                        @if($article->pdf_file)
                            <a href="{{ route('articles.pdf', $article->slug) }}"
                                class="text-xs border border-gold text-gold px-2 py-1 rounded hover:bg-gold hover:text-white transition-colors">📥
                                PDF</a>
                        @endif
                        <a href="{{ route('articles.show', $article->slug) }}"
                            class="text-xs text-navy font-medium hover:text-gold">O'qish →</a>
                        <span class="text-xs text-gray-400 ml-auto">👁 {{ $article->view_count }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Conferences --}}
    @if($conferences->count() > 0)
        <section class="bg-navy-dark text-white">
            <div class="max-w-7xl mx-auto px-4 py-12">
                <h2 class="font-display text-2xl font-bold mb-8 text-gold-light">📅 Konferensiyalar</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($conferences as $conf)
                        <div class="bg-navy rounded-xl p-6 border border-navy-light hover:border-gold transition-colors">
                            <div class="text-xs text-gold-light mb-2">{{ $conf->start_date?->format('d.m.Y') }}</div>
                            <h3 class="font-semibold text-lg mb-2">{{ $conf->title }}</h3>
                            <p class="text-sm text-blue-200 mb-4">📍 {{ $conf->venue ?? ($conf->is_online ? 'Online' : '') }}</p>
                            <a href="{{ route('conferences.show', $conf->slug) }}"
                                class="text-sm text-gold hover:text-gold-light">Batafsil →</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Journals --}}
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="font-display text-2xl font-bold text-navy-dark mb-8">📰 Jurnallar</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($journals as $journal)
                <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-md transition-shadow flex gap-4">
                    <div
                        class="w-16 h-20 bg-navy-dark rounded-lg flex items-center justify-center text-white text-2xl flex-shrink-0">
                        📰</div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-navy-dark mb-1">{{ $journal->name }}</h3>
                        <div class="flex flex-wrap gap-2 mb-2">
                            @if($journal->issn_online)<span class="text-xs text-gray-500">ISSN:
                            {{ $journal->issn_online }}</span>@endif
                        </div>
                        <div class="flex flex-wrap gap-1">
                            @if($journal->is_indexed_google_scholar)<span
                            class="text-xs bg-green-50 text-green-700 px-2 py-0.5 rounded">Google Scholar</span>@endif
                            @if($journal->is_indexed_hak)<span
                            class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded">OAK</span>@endif
                            @if($journal->is_indexed_scopus)<span
                            class="text-xs bg-purple-50 text-purple-700 px-2 py-0.5 rounded">Scopus</span>@endif
                        </div>
                        <a href="{{ route('journals.show', $journal->slug) }}"
                            class="text-xs text-gold font-medium hover:text-gold-light mt-2 inline-block">Ko'rish →</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- News --}}
    @if($news->count() > 0)
        <section class="bg-gray-50 border-t">
            <div class="max-w-7xl mx-auto px-4 py-12">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="font-display text-2xl font-bold text-navy-dark">📢 Yangiliklar</h2>
                    <a href="{{ route('news.index') }}" class="text-sm text-gold hover:text-gold-light font-medium">Barchasi
                        →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($news as $item)
                        <div class="bg-white rounded-xl border p-5 hover:shadow-md transition-shadow">
                            <div class="text-xs text-gray-400 mb-2">{{ $item->published_at?->format('d.m.Y') }}</div>
                            <h3 class="font-semibold text-navy-dark mb-2">
                                <a href="{{ route('news.show', $item->slug) }}"
                                    class="hover:text-gold transition-colors">{{ $item->title }}</a>
                            </h3>
                            <p class="text-sm text-gray-600 line-clamp-3">{{ $item->excerpt }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Subscription --}}
    <section class="bg-gold-pale border-t">
        <div class="max-w-7xl mx-auto px-4 py-12 text-center">
            <h2 class="font-display text-2xl font-bold text-navy-dark mb-2">Yangiliklardan xabardor bo'ling</h2>
            <p class="text-gray-600 mb-6">Email manzilingizni qoldiring va yangi sonlar haqida birinchi bo'lib bilib oling.
            </p>
            <form method="POST" action="{{ route('subscribe') }}" class="flex max-w-md mx-auto gap-2">
                @csrf
                <input type="email" name="email" placeholder="Email manzilingiz" required
                    class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                <button
                    class="bg-navy hover:bg-navy-dark text-white font-medium px-5 py-2.5 rounded-lg transition-colors text-sm">Obuna</button>
            </form>
            @if(session('subscribed'))
                <p class="text-green-600 text-sm mt-2">{{ session('subscribed') }}</p>
            @endif
            @error('email')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
        </div>
    </section>
@endsection