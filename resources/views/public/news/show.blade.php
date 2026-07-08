@extends('public.layouts.app')
@section('title', (title) . ' — Yangiliklar')
@section('content')
    <div class="max-w-3xl mx-auto px-4 py-12">
        <a href="{{ route('news.index') }}" class="text-sm text-gray-500 hover:text-navy mb-4 inline-block">←
            Yangiliklar</a>
        <article class="bg-white rounded-xl border p-8">
            <div class="text-xs text-gray-400 mb-2">{{ $newsItem->published_at?->format('d.m.Y') }}</div>
            <h1 class="font-display text-2xl md:text-3xl font-bold text-navy-dark mb-4">{{ $newsItem->title }}</h1>
            @if($newsItem->title)
            <p class="text-gray-500 italic mb-4">{{ $newsItem->title }}</p>@endif
            <div class="prose max-w-none text-gray-700 leading-relaxed">{!! $newsItem->body !!}</div>
        </article>
    </div>
@endsection