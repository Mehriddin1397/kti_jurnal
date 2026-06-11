@extends('admin.layouts.app')
@section('page_title', 'Dashboard')

@section('content')
    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Jami maqolalar</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_articles'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">Bu oy: +{{ $stats['this_month_articles'] }}</p>
                </div>
                <div class="text-2xl">📄</div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Jurnallar</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_journals'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">Aktiv: {{ $stats['active_journals'] }}</p>
                </div>
                <div class="text-2xl">📰</div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Kutayotganlar</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_submissions'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">Ko'rib chiqish kerak</p>
                </div>
                <div class="text-2xl">📩</div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Mualliflar</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_authors'] }}</p>
                </div>
                <div class="text-2xl">👥</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Monthly Chart --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-5">
            <h3 class="font-semibold text-gray-800 mb-4">
                📊 Oylik maqolalar (12 oy)
            </h3>

            <div class="flex items-end gap-2 h-40">
                @php
                    $max = max(max(array_column($monthlyData, 'count')), 1);
                @endphp

                @foreach($monthlyData as $m)
                    <div class="flex-1 h-full flex flex-col justify-end items-center gap-1">

                        <span class="text-xs text-gray-500">
                            {{ $m['count'] }}
                        </span>

                        <div class="w-full bg-navy rounded-t transition-all duration-500"
                            style="height: {{ ($m['count'] / $max) * 100 }}%">
                        </div>

                        <span class="text-xs text-gray-400">
                            {{ $m['month'] }}
                        </span>

                    </div>
                @endforeach
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h3 class="font-semibold text-gray-800 mb-4">⚡ Tezkor havolalar</h3>
            <div class="space-y-2">
                <a href="{{ route('admin.articles.create') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <span
                        class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-sm">📄</span>
                    <span class="text-sm text-gray-700">Yangi maqola qo'shish</span>
                </a>
                <a href="{{ route('admin.journals.create') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <span
                        class="w-8 h-8 bg-green-50 text-green-600 rounded-lg flex items-center justify-center text-sm">📰</span>
                    <span class="text-sm text-gray-700">Yangi jurnal yaratish</span>
                </a>
                <a href="{{ route('admin.submissions.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <span
                        class="w-8 h-8 bg-yellow-50 text-yellow-600 rounded-lg flex items-center justify-center text-sm">📩</span>
                    <span class="text-sm text-gray-700">Yuborilganlarni ko'rish</span>
                </a>
                <a href="{{ route('admin.authors.create') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <span
                        class="w-8 h-8 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center text-sm">👥</span>
                    <span class="text-sm text-gray-700">Muallif qo'shish</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="mt-6 bg-white rounded-xl border border-gray-200 p-5">
        <h3 class="font-semibold text-gray-800 mb-4">🕐 So'nggi maqolalar</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 border-b">
                        <th class="pb-2 font-medium">#</th>
                        <th class="pb-2 font-medium">Sarlavha</th>
                        <th class="pb-2 font-medium">Jurnal</th>
                        <th class="pb-2 font-medium">Holat</th>
                        <th class="pb-2 font-medium">Sana</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentArticles as $article)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-2 text-gray-400">{{ $article->id }}</td>
                            <td class="py-2">
                                <a href="{{ route('admin.articles.edit', $article) }}"
                                    class="text-navy hover:text-gold font-medium">
                                    {{ Str::limit($article->title_uz ?: $article->title_en, 50) }}
                                </a>
                            </td>
                            <td class="py-2 text-gray-500">{{ $article->journal->name_uz ?? '—' }}</td>
                            <td class="py-2">
                                <span class="px-2 py-0.5 rounded-full text-xs
                                                                            @if($article->status === 'published') bg-green-50 text-green-700
                                                                            @elseif($article->status === 'accepted') bg-blue-50 text-blue-700
                                                                            @elseif($article->status === 'under_review') bg-yellow-50 text-yellow-700
                                                                            @elseif($article->status === 'rejected') bg-red-50 text-red-700
                                                                            @else bg-gray-50 text-gray-700
                                                                            @endif">
                                    {{ $article->status }}
                                </span>
                            </td>
                            <td class="py-2 text-gray-400">{{ $article->created_at->format('d.m.Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection