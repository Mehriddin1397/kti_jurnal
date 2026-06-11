@extends('public.layouts.app')
@section('title', 'Konferensiyalar — Kriminologiya')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12" x-data="{ tab: 'upcoming' }">
        <h1 class="font-display text-3xl font-bold text-navy-dark mb-6">Konferensiyalar</h1>
        <div class="flex gap-2 border-b mb-6">
            <button @click="tab='upcoming'"
                :class="tab==='upcoming' ? 'border-navy text-navy' : 'border-transparent text-gray-500'"
                class="px-4 py-2 text-sm font-medium border-b-2 transition-colors">Aktiv / Kutilmoqda</button>
            <button @click="tab='past'" :class="tab==='past' ? 'border-navy text-navy' : 'border-transparent text-gray-500'"
                class="px-4 py-2 text-sm font-medium border-b-2 transition-colors">O'tgan</button>
        </div>
        <div x-show="tab==='upcoming'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($upcoming as $conf)
                <div class="bg-white rounded-xl border p-6 hover:shadow-md transition-shadow">
                    <div class="text-xs text-gold font-medium mb-2">{{ $conf->start_date?->format('d.m.Y') }} —
                        {{ $conf->end_date?->format('d.m.Y') }}</div>
                    <h3 class="font-semibold text-navy-dark text-lg mb-2">{{ $conf->title_uz }}</h3>
                    <p class="text-sm text-gray-600 mb-3">📍 {{ $conf->venue ?? ($conf->is_online ? 'Online' : '') }}</p>
                    @if($conf->submission_deadline)
                        <p class="text-xs text-gray-500">📝 Maqola muddati: {{ $conf->submission_deadline->format('d.m.Y') }}</p>
                    @endif
                    <a href="{{ route('conferences.show', $conf->slug) }}"
                        class="inline-block mt-3 text-sm text-gold font-medium hover:text-gold-light">Batafsil →</a>
                </div>
            @empty
                <p class="text-gray-400 col-span-3">Hozirda aktiv konferensiyalar yo'q</p>
            @endforelse
        </div>
        <div x-show="tab==='past'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($past as $conf)
                <div class="bg-white rounded-xl border p-6 opacity-75">
                    <div class="text-xs text-gray-400 mb-2">{{ $conf->start_date?->format('d.m.Y') }}</div>
                    <h3 class="font-semibold text-gray-700 mb-2">{{ $conf->title_uz }}</h3>
                    <a href="{{ route('conferences.show', $conf->slug) }}" class="text-sm text-navy hover:text-gold">Ko'rish
                        →</a>
                </div>
            @empty
                <p class="text-gray-400 col-span-3">O'tgan konferensiyalar yo'q</p>
            @endforelse
        </div>
    </div>
@endsection