@extends('public.layouts.app')
@section('title', (name) . ' — Kriminologiya')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    {{-- Header --}}
    <div class="bg-white rounded-xl border p-8 mb-8">
        <h1 class="font-display text-3xl font-bold text-navy-dark mb-2">{{ $journal->name }}</h1>
        @if($journal->name)<p class="text-gray-500">{{ $journal->name }}</p>@endif
        <div class="flex flex-wrap gap-4 mt-4 text-sm text-gray-600">
            @if($journal->issn_print)<span>Print ISSN: <strong>{{ $journal->issn_print }}</strong></span>@endif
            @if($journal->issn_online)<span>Online ISSN: <strong>{{ $journal->issn_online }}</strong></span>@endif
            @if($journal->chief_editor)<span>Bosh muharrir: <strong>{{ $journal->chief_editor }}</strong></span>@endif
        </div>
        <div class="flex flex-wrap gap-1 mt-3">
            @if($journal->is_indexed_google_scholar)<span class="text-xs bg-green-50 text-green-700 px-2 py-0.5 rounded">Google Scholar</span>@endif
            @if($journal->is_indexed_hak)<span class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded">OAK</span>@endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Content with Tabs --}}
        <div class="lg:col-span-2" x-data="{ tab: 'about' }">
            <div class="flex gap-2 border-b mb-6 overflow-x-auto">
                @foreach(['about'=>'Haqida','issues'=>'Sonlar','editors'=>'Muharrirlar','guidelines'=>'Ko\'rsatmalar','indexing'=>'Indekslash'] as $k=>$l)
                <button @click="tab='{{ $k }}'" :class="tab==='{{ $k }}' ? 'border-navy text-navy' : 'border-transparent text-gray-500'" class="px-4 py-2 text-sm font-medium border-b-2 transition-colors whitespace-nowrap">{{ $l }}</button>
                @endforeach
            </div>

            <div x-show="tab==='about'" class="bg-white rounded-xl border p-6"
                x-data="{
                    aboutOpen: false,
                    selected: @json($aboutPages->first()?->slug),
                    pages: @json($aboutPagesData)
                }">
                @if($aboutPages->isNotEmpty())
                <div class="relative mb-6">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Bo'limni tanlang</label>
                    <button type="button" @click="aboutOpen = !aboutOpen"
                        class="w-full flex items-center justify-between gap-3 px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 hover:bg-white transition-colors text-left">
                        <span>
                            <span class="block font-semibold text-navy-dark"
                                x-text="pages.find(p => p.slug === selected)?.title_uz"></span>
                            <span class="block text-xs text-gray-500 mt-0.5 line-clamp-2"
                                x-text="pages.find(p => p.slug === selected)?.description_uz"></span>
                        </span>
                        <span class="text-gray-400 flex-shrink-0" x-text="aboutOpen ? '▴' : '▾'"></span>
                    </button>
                    <div x-show="aboutOpen" @click.outside="aboutOpen = false" x-cloak
                        class="absolute z-20 left-0 right-0 mt-2 max-h-80 overflow-y-auto bg-white border border-gray-200 rounded-lg shadow-lg">
                        <template x-for="page in pages" :key="page.slug">
                            <button type="button" @click="selected = page.slug; aboutOpen = false"
                                :class="selected === page.slug ? 'bg-gold-pale border-l-4 border-gold' : 'hover:bg-gray-50 border-l-4 border-transparent'"
                                class="w-full text-left px-4 py-3 border-b border-gray-100 last:border-b-0 transition-colors">
                                <span class="block text-sm font-medium text-navy-dark" x-text="page.title_uz"></span>
                                <span class="block text-xs text-gray-500 mt-1" x-text="page.description_uz"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <template x-for="page in pages" :key="'content-' + page.slug">
                    <div x-show="selected === page.slug" class="space-y-6">
                        <div class="border border-gray-100 rounded-lg p-4">
                            <span class="inline-block text-xs font-semibold uppercase tracking-wide text-navy bg-gold-pale px-2 py-0.5 rounded mb-2">O'zbek</span>
                            <h3 class="font-semibold text-navy-dark text-lg" x-text="page.title_uz"></h3>
                            <p class="text-sm text-gray-600 mt-2 leading-relaxed" x-text="page.description_uz"></p>
                            <div x-show="page.body_uz" class="text-sm text-gray-700 leading-relaxed mt-4 whitespace-pre-line" x-text="page.body_uz"></div>
                        </div>
                        <div x-show="page.title_en || page.description_en || page.body_en" class="border border-gray-100 rounded-lg p-4">
                            <span class="inline-block text-xs font-semibold uppercase tracking-wide text-navy bg-blue-50 px-2 py-0.5 rounded mb-2">English</span>
                            <h3 class="font-semibold text-navy-dark text-lg" x-text="page.title_en || page.title_uz"></h3>
                            <p class="text-sm text-gray-600 mt-2 leading-relaxed" x-text="page.description_en || page.description_uz"></p>
                            <div x-show="page.body_en" class="text-sm text-gray-700 leading-relaxed mt-4 whitespace-pre-line" x-text="page.body_en"></div>
                        </div>
                        <div x-show="page.title_ru || page.description_ru || page.body_ru" class="border border-gray-100 rounded-lg p-4">
                            <span class="inline-block text-xs font-semibold uppercase tracking-wide text-navy bg-red-50 px-2 py-0.5 rounded mb-2">Русский</span>
                            <h3 class="font-semibold text-navy-dark text-lg" x-text="page.title_ru || page.title_uz"></h3>
                            <p class="text-sm text-gray-600 mt-2 leading-relaxed" x-text="page.description_ru || page.description_uz"></p>
                            <div x-show="page.body_ru" class="text-sm text-gray-700 leading-relaxed mt-4 whitespace-pre-line" x-text="page.body_ru"></div>
                        </div>
                    </div>
                </template>
                @else
                <p class="text-sm text-gray-500">Haqida bo'limlari hali qo'shilmagan.</p>
                @endif
            </div>

            <div x-show="tab==='issues'" class="bg-white rounded-xl border p-6">
                <h3 class="font-semibold text-navy-dark mb-4">Sonlar bo'yicha maqolalar</h3>
                @foreach($volumes as $vol)
                <div class="mb-4">
                    <h4 class="text-sm font-semibold text-navy bg-gray-50 px-3 py-2 rounded">Tom {{ $vol->volume }}, Son {{ $vol->issue }}</h4>
                </div>
                @endforeach
                @foreach($articles as $article)
                <div class="py-3 border-b border-gray-100">
                    <a href="{{ route('articles.show', $article->slug) }}" class="text-navy hover:text-gold font-medium text-sm">{{ title }}</a>
                    <p class="text-xs text-gray-500 mt-1">{{ $article->authors_string }} · {{ $article->published_at?->format('Y') }}</p>
                </div>
                @endforeach
                <div class="mt-4">{{ $articles->links() }}</div>
            </div>

            <div x-show="tab==='editors'" class="bg-white rounded-xl border p-6">
                <h3 class="font-semibold text-navy-dark mb-3">Muharrirlar hay'ati</h3>
                @if($journal->chief_editor)
                <div class="p-4 bg-gold-pale rounded-lg mb-4">
                    <p class="font-semibold text-navy">{{ $journal->chief_editor }}</p>
                    <p class="text-sm text-gray-600">{{ $journal->chief_editor_title ?? 'Bosh muharrir' }}</p>
                </div>
                @endif
            </div>

            <div x-show="tab==='guidelines'" class="bg-white rounded-xl border p-6">
                <h3 class="font-semibold text-navy-dark mb-3">Muallif ko'rsatmalari</h3>
                <div class="text-sm text-gray-700 leading-relaxed">{!! nl2br(e($journal->author_guidelines)) !!}</div>
            </div>

            <div x-show="tab==='indexing'" class="bg-white rounded-xl border p-6">
                <h3 class="font-semibold text-navy-dark mb-3">Indekslash holati</h3>
                <div class="space-y-2">
                    @foreach([
                        ['is_indexed_google_scholar', 'Google Scholar', 'green'],
                        ['is_indexed_hak', 'OAK (HAK)', 'blue'],
                        ['is_indexed_inlibrary', 'inLibrary', 'orange'],
                        ['is_indexed_scopus', 'Scopus', 'purple'],
                    ] as [$field, $name, $color])
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <span class="w-3 h-3 rounded-full {{ $journal->$field ? 'bg-'.$color.'-500' : 'bg-gray-300' }}"></span>
                        <span class="text-sm">{{ $name }}</span>
                        <span class="text-xs {{ $journal->$field ? 'text-green-600' : 'text-gray-400' }} ml-auto">{{ $journal->$field ? '✓ Indekslangan' : '✗ Indekslanmagan' }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl border p-5">
                <h4 class="font-semibold text-navy-dark mb-3">Ma'lumot</h4>
                <div class="space-y-2 text-sm text-gray-600">
                    <div>📅 Nashr chastotasi: <strong>{{ ucfirst($journal->frequency) }}</strong></div>
                    @if($journal->founding_year)<div>🏛 Tashkil etilgan: <strong>{{ $journal->founding_year }}</strong></div>@endif
                    @if($journal->submission_email)<div>📧 {{ $journal->submission_email }}</div>@endif
                </div>
            </div>
            <a href="{{ route('submit.create') }}" class="block bg-gold hover:bg-gold-light text-white text-center font-medium py-3 rounded-lg transition-colors">📝 Maqola yuborish</a>
        </div>
    </div>
</div>
@endsection
