@extends('public.layouts.app')
@section('title', __('site.news.title') . ' — ' . __('site.footer.brand'))
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="font-display text-3xl font-bold text-navy-dark mb-8">{{ __('site.news.title') }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($news as $item)
                <div class="bg-white rounded-xl border p-5 hover:shadow-md transition-shadow">
                    <div class="text-xs text-gray-400 mb-2">{{ $item->published_at?->format('d.m.Y') }}</div>
                    <h2 class="font-semibold text-navy-dark mb-2"><a href="{{ route('news.show', $item->slug) }}"
                            class="hover:text-gold transition-colors">{{ $item->title }}</a></h2>
                    <p class="text-sm text-gray-600 line-clamp-3">{{ $item->excerpt }}</p>
                    <a href="{{ route('news.show', $item->slug) }}"
                        class="text-sm text-gold font-medium mt-3 inline-block hover:text-gold-light">{{ __('site.news.read') }} →</a>
                </div>
            @empty
                <p class="text-gray-400">{{ __('site.news.not_found') }}</p>
            @endforelse
        </div>
        <div class="mt-6">{{ $news->links() }}</div>
    </div>
@endsection