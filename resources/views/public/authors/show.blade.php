@extends('public.layouts.app')
@section('title', $author->full_name . ' — Kriminologiya')
@section('content')
    <div class="max-w-5xl mx-auto px-4 py-12">
        <div class="bg-white rounded-xl border p-8 mb-8">
            <div class="flex items-start gap-6">
                <div
                    class="w-20 h-20 bg-navy rounded-full flex items-center justify-center text-white text-2xl flex-shrink-0">
                    @if($author->photo)<img src="{{ Storage::disk('public')->url($author->photo) }}"
                    class="w-20 h-20 rounded-full object-cover">@else 👤 @endif
                </div>
                <div>
                    <h1 class="font-display text-2xl font-bold text-navy-dark">{{ $author->full_name }}</h1>
                    @if($author->organization)
                    <p class="text-gray-600">{{ $author->organization }}</p>@endif
                    <div class="flex flex-wrap gap-3 mt-2 text-sm text-gray-500">
                        @if($author->email)<span>📧 {{ $author->email }}</span>@endif
                        @if($author->orcid)<span>ORCID: <a href="https://orcid.org/{{ $author->orcid }}"
                        class="text-navy hover:text-gold" target="_blank">{{ $author->orcid }}</a></span>@endif
                        @if($author->country)<span>📍 {{ $author->country }}</span>@endif
                    </div>
                    @if($author->bio)
                    <p class="text-sm text-gray-700 mt-3">{{ $author->bio }}</p>@endif
                </div>
            </div>
        </div>
        <h2 class="font-display text-xl font-bold text-navy-dark mb-4">Nashr etilgan maqolalar</h2>
        <div class="space-y-3">
            @foreach($articles as $article)
                <div class="bg-white rounded-xl border p-5 hover:shadow-md transition-shadow">
                    <a href="{{ route('articles.show', $article->slug) }}"
                        class="font-semibold text-navy hover:text-gold">{{ $article->title }}</a>
                    <p class="text-xs text-gray-500 mt-1">{{ $article->journal->name ?? '' }} ·
                        {{ $article->published_at?->format('Y') }} · Tom {{ $article->volume }}, Son {{ $article->issue }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $articles->links() }}</div>
    </div>
@endsection