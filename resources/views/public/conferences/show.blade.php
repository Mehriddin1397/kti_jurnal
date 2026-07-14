@extends('public.layouts.app')
@section('title', $conference->title . ' — ' . __('site.conferences.title'))
@section('content')
    <div class="max-w-5xl mx-auto px-4 py-12">
        <a href="{{ route('conferences.index') }}" class="text-sm text-gray-500 hover:text-navy mb-4 inline-block">←
            {{ __('site.conference.back') }}</a>
        <div class="bg-white rounded-xl border p-8 mb-6">
            <div class="flex items-center gap-2 mb-3">
                <span
                    class="px-2 py-0.5 rounded-full text-xs bg-{{ $conference->status_color }}-50 text-{{ $conference->status_color }}-700">{{ $conference->status }}</span>
                @if($conference->is_online)<span
                class="px-2 py-0.5 rounded-full text-xs bg-blue-50 text-blue-700">{{ __('site.conference.online') }}</span>@endif
            </div>
            <h1 class="font-display text-3xl font-bold text-navy-dark mb-2">{{ $conference->title }}</h1>
            @if($conference->title)
            <p class="text-gray-500 italic mb-4">{{ $conference->title }}</p>@endif
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-600 mb-6">
                <div>📅 <strong>{{ __('site.conference.starts') }}</strong><br>{{ $conference->start_date?->format('d.m.Y') }}</div>
                <div>📅 <strong>{{ __('site.conference.ends') }}</strong><br>{{ $conference->end_date?->format('d.m.Y') }}</div>
                @if($conference->submission_deadline)
                    <div>📝 <strong>{{ __('site.conference.submission_deadline') }}</strong><br>{{ $conference->submission_deadline->format('d.m.Y') }}</div>
                @endif
                @if($conference->venue)
                <div>📍 <strong>{{ __('site.conference.venue') }}</strong><br>{{ $conference->venue }}</div>@endif
            </div>
            @if($conference->description)
                <h3 class="font-semibold text-navy-dark mb-2">{{ __('site.conference.description_heading') }}</h3>
                <p class="text-gray-700 leading-relaxed mb-4">{{ $conference->description }}</p>
            @endif
            @if($conference->topics)
                <h3 class="font-semibold text-navy-dark mb-2">{{ __('site.conference.topics_heading') }}</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $conference->topics) as $topic)
                        <span class="bg-blue-50 text-blue-700 text-xs px-2 py-1 rounded">{{ trim($topic) }}</span>
                    @endforeach
                </div>
            @endif
            @if($conference->pdf_file)
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h3 class="font-semibold text-navy-dark mb-4">{{ __('site.conference.proceedings_heading') }}</h3>
                    <a href="{{ $conference->pdf_url }}" target="_blank"
                        class="inline-flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 font-medium px-4 py-2 rounded-lg transition-colors">
                        📄 {{ __('site.conference.download_proceedings') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection