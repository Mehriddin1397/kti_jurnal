@extends('public.layouts.app')
@section('title', $journal->name . ' — ' . __('site.footer.brand'))
@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    {{-- Header --}}
    <div class="bg-white rounded-xl border p-8 mb-8">
        <h1 class="font-display text-3xl font-bold text-navy-dark mb-2">{{ $journal->name }}</h1>
        @if($journal->name)<p class="text-gray-500">{{ $journal->name }}</p>@endif
        <div class="flex flex-wrap gap-4 mt-4 text-sm text-gray-600">
            @if($journal->issn_print)<span>{{ __('site.journal.print_issn') }} <strong>{{ $journal->issn_print }}</strong></span>@endif
            @if($journal->issn_online)<span>{{ __('site.journal.online_issn') }} <strong>{{ $journal->issn_online }}</strong></span>@endif
            @if($journal->chief_editor)<span>{{ __('site.journal.chief_editor') }} <strong>{{ $journal->chief_editor }}</strong></span>@endif
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
                @foreach(['about'=>__('site.journal.tab_about'),'issues'=>__('site.journal.tab_issues'),'editors'=>__('site.journal.tab_editors'),'guidelines'=>__('site.journal.tab_guidelines'),'indexing'=>__('site.journal.tab_indexing')] as $k=>$l)
                <button @click="tab='{{ $k }}'" :class="tab==='{{ $k }}' ? 'border-navy text-navy' : 'border-transparent text-gray-500'" class="px-4 py-2 text-sm font-medium border-b-2 transition-colors whitespace-nowrap">{{ $l }}</button>
                @endforeach
            </div>

            <div x-show="tab==='about'" class="bg-white rounded-xl border p-6"
                x-data='{
                    selected: @json($aboutPages->first()?->slug),
                    pages: @json($aboutPagesData)
                }'>
                @if($aboutPages->isNotEmpty())
                <div class="flex flex-col md:flex-row gap-6 items-start">
                    {{-- Plain vertical list, like the About menu on in-academy.uz --}}
                    <nav class="w-full md:w-64 flex-shrink-0 border border-gray-200 rounded-lg divide-y divide-gray-100 overflow-hidden">
                        <template x-for="page in pages" :key="page.slug">
                            <button type="button" @click="selected = page.slug"
                                :class="selected === page.slug ? 'bg-gold-pale text-navy font-semibold' : 'text-gray-700 hover:bg-gray-50'"
                                class="w-full text-left px-4 py-2.5 text-sm transition-colors" x-text="page.title_uz"></button>
                        </template>
                    </nav>

                    <div class="flex-1 min-w-0 w-full">
                        <template x-for="page in pages" :key="'content-' + page.slug">
                            <div x-show="selected === page.slug" class="space-y-6">
                                <div class="border border-gray-100 rounded-lg p-4">
                                    <span class="inline-block text-xs font-semibold uppercase tracking-wide text-navy bg-gold-pale px-2 py-0.5 rounded mb-2">{{ __('site.journal.lang_uz') }}</span>
                                    <h3 class="font-semibold text-navy-dark text-lg" x-text="page.title_uz"></h3>
                                    <p class="text-sm text-gray-600 mt-2 leading-relaxed" x-text="page.description_uz"></p>
                                    <div x-show="page.body_uz" class="text-sm text-gray-700 leading-relaxed mt-4 whitespace-pre-line" x-text="page.body_uz"></div>
                                </div>
                                <div x-show="page.title_en || page.description_en || page.body_en" class="border border-gray-100 rounded-lg p-4">
                                    <span class="inline-block text-xs font-semibold uppercase tracking-wide text-navy bg-blue-50 px-2 py-0.5 rounded mb-2">{{ __('site.journal.lang_en') }}</span>
                                    <h3 class="font-semibold text-navy-dark text-lg" x-text="page.title_en || page.title_uz"></h3>
                                    <p class="text-sm text-gray-600 mt-2 leading-relaxed" x-text="page.description_en || page.description_uz"></p>
                                    <div x-show="page.body_en" class="text-sm text-gray-700 leading-relaxed mt-4 whitespace-pre-line" x-text="page.body_en"></div>
                                </div>
                                <div x-show="page.title_ru || page.description_ru || page.body_ru" class="border border-gray-100 rounded-lg p-4">
                                    <span class="inline-block text-xs font-semibold uppercase tracking-wide text-navy bg-red-50 px-2 py-0.5 rounded mb-2">{{ __('site.journal.lang_ru') }}</span>
                                    <h3 class="font-semibold text-navy-dark text-lg" x-text="page.title_ru || page.title_uz"></h3>
                                    <p class="text-sm text-gray-600 mt-2 leading-relaxed" x-text="page.description_ru || page.description_uz"></p>
                                    <div x-show="page.body_ru" class="text-sm text-gray-700 leading-relaxed mt-4 whitespace-pre-line" x-text="page.body_ru"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                @else
                <p class="text-sm text-gray-500">{{ __('site.journal.no_about_pages') }}</p>
                @endif
            </div>

            <div x-show="tab==='issues'" class="bg-white rounded-xl border p-6"
                x-data='{
                    selectedIssue: @json($defaultIssueKey),
                    issues: @json($issues)
                }'>
                <h3 class="font-semibold text-navy-dark mb-4">{{ __('site.journal.issues_heading') }}</h3>
                @if($issues->isNotEmpty())
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-6">
                    <label class="text-sm font-medium text-gray-600">{{ __('site.journal.select_issue') }}</label>
                    <select x-model="selectedIssue"
                        class="px-3 py-2 border border-gray-200 rounded-lg text-sm bg-gray-50 focus:ring-2 focus:ring-navy outline-none">
                        <template x-for="iss in issues" :key="iss.key">
                            <option :value="iss.key" x-text="'{{ __('site.journal.volume') }} ' + iss.volume + ', {{ __('site.journal.issue') }} ' + iss.issue"></option>
                        </template>
                    </select>
                </div>

                <template x-for="iss in issues" :key="'issue-' + iss.key">
                    <div x-show="selectedIssue === iss.key" class="divide-y divide-gray-100">
                        <template x-for="article in iss.articles" :key="article.slug">
                            <div class="py-3">
                                <a :href="'{{ url('/articles') }}/' + article.slug"
                                    class="text-navy hover:text-gold font-medium text-sm" x-text="article.title"></a>
                                <p class="text-xs text-gray-500 mt-1"
                                    x-text="article.authors + (article.year ? ' · ' + article.year : '')"></p>
                            </div>
                        </template>
                    </div>
                </template>
                @else
                <p class="text-sm text-gray-500">{{ __('site.journal.no_issues') }}</p>
                @endif
            </div>

            <div x-show="tab==='editors'" class="bg-white rounded-xl border p-6">
                <h3 class="font-semibold text-navy-dark mb-3">{{ __('site.journal.editors_heading') }}</h3>
                @if($journal->chief_editor)
                <div class="p-4 bg-gold-pale rounded-lg mb-4">
                    <p class="font-semibold text-navy">{{ $journal->chief_editor }}</p>
                    <p class="text-sm text-gray-600">{{ $journal->chief_editor_title ?? __('site.journal.chief_editor_fallback') }}</p>
                </div>
                @endif
            </div>

            <div x-show="tab==='guidelines'" class="bg-white rounded-xl border p-6">
                <h3 class="font-semibold text-navy-dark mb-3">{{ __('site.journal.guidelines_heading') }}</h3>
                <div class="text-sm text-gray-700 leading-relaxed">{!! nl2br(e($journal->author_guidelines)) !!}</div>
            </div>

            <div x-show="tab==='indexing'" class="bg-white rounded-xl border p-6">
                <h3 class="font-semibold text-navy-dark mb-3">{{ __('site.journal.indexing_heading') }}</h3>
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
                        <span class="text-xs {{ $journal->$field ? 'text-green-600' : 'text-gray-400' }} ml-auto">{{ $journal->$field ? '✓ ' . __('site.journal.indexed') : '✗ ' . __('site.journal.not_indexed') }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl border p-5">
                <h4 class="font-semibold text-navy-dark mb-3">{{ __('site.journal.info_heading') }}</h4>
                <div class="space-y-2 text-sm text-gray-600">
                    <div>📅 {{ __('site.journal.frequency') }} <strong>{{ ucfirst($journal->frequency) }}</strong></div>
                    @if($journal->founding_year)<div>🏛 {{ __('site.journal.founded') }} <strong>{{ $journal->founding_year }}</strong></div>@endif
                    @if($journal->submission_email)<div>📧 {{ $journal->submission_email }}</div>@endif
                </div>
            </div>
            <a href="{{ route('submit.create') }}" class="block bg-gold hover:bg-gold-light text-white text-center font-medium py-3 rounded-lg transition-colors">📝 {{ __('site.journal.submit_article') }}</a>
        </div>
    </div>
</div>
@endsection
