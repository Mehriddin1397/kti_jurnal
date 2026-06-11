@extends('public.layouts.app')
@section('title', ($conference->title_uz ?: $conference->title_en) . ' — Konferensiya')
@section('content')
    <div class="max-w-5xl mx-auto px-4 py-12">
        <a href="{{ route('conferences.index') }}" class="text-sm text-gray-500 hover:text-navy mb-4 inline-block">←
            Konferensiyalar</a>
        <div class="bg-white rounded-xl border p-8 mb-6">
            <div class="flex items-center gap-2 mb-3">
                <span
                    class="px-2 py-0.5 rounded-full text-xs bg-{{ $conference->status_color }}-50 text-{{ $conference->status_color }}-700">{{ $conference->status }}</span>
                @if($conference->is_online)<span
                class="px-2 py-0.5 rounded-full text-xs bg-blue-50 text-blue-700">Online</span>@endif
            </div>
            <h1 class="font-display text-3xl font-bold text-navy-dark mb-2">{{ $conference->title_uz }}</h1>
            @if($conference->title_en)
            <p class="text-gray-500 italic mb-4">{{ $conference->title_en }}</p>@endif
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-600 mb-6">
                <div>📅 <strong>Boshlanishi:</strong><br>{{ $conference->start_date?->format('d.m.Y') }}</div>
                <div>📅 <strong>Tugashi:</strong><br>{{ $conference->end_date?->format('d.m.Y') }}</div>
                @if($conference->submission_deadline)
                    <div>📝 <strong>Maqola muddati:</strong><br>{{ $conference->submission_deadline->format('d.m.Y') }}</div>
                @endif
                @if($conference->venue)
                <div>📍 <strong>Joy:</strong><br>{{ $conference->venue }}</div>@endif
            </div>
            @if($conference->description_uz)
                <h3 class="font-semibold text-navy-dark mb-2">Tavsif</h3>
                <p class="text-gray-700 leading-relaxed mb-4">{{ $conference->description_uz }}</p>
            @endif
            @if($conference->topics)
                <h3 class="font-semibold text-navy-dark mb-2">Mavzular</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $conference->topics) as $topic)
                        <span class="bg-blue-50 text-blue-700 text-xs px-2 py-1 rounded">{{ trim($topic) }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection