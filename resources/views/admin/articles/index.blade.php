@extends('admin.layouts.app')
@section('page_title', 'Maqolalar')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Maqolalar</h1>
        </div>
        <a href="{{ route('admin.articles.create') }}"
            class="bg-navy hover:bg-navy-dark text-white text-sm font-medium px-4 py-2 rounded-lg">+ Yangi maqola</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4">
        <form method="GET" class="flex flex-wrap gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Qidirish..."
                class="flex-1 min-w-[200px] px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
            <select name="journal_id" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                <option value="">Barcha jurnallar</option>
                @foreach($journals as $j)
                    <option value="{{ $j->id }}" {{ request('journal_id') == $j->id ? 'selected' : '' }}>{{ $j->name_uz }}
                    </option>
                @endforeach
            </select>
            <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                <option value="">Barcha holatlar</option>
                @foreach(['draft' => 'Qoralama', 'under_review' => 'Ko\'rib chiqilmoqda', 'accepted' => 'Qabul qilingan', 'published' => 'Chop etilgan', 'rejected' => 'Rad etilgan'] as $val => $lbl)
                    <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                @endforeach
            </select>
            <button class="bg-navy text-white text-sm px-4 py-2 rounded-lg">Filtrlash</button>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-gray-600">
                    <th class="px-4 py-3 font-medium">#</th>
                    <th class="px-4 py-3 font-medium">Sarlavha</th>
                    <th class="px-4 py-3 font-medium">Jurnal</th>
                    <th class="px-4 py-3 font-medium">Tom/Son</th>
                    <th class="px-4 py-3 font-medium">Holat</th>
                    <th class="px-4 py-3 font-medium">Sana</th>
                    <th class="px-4 py-3 font-medium">Amallar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-400">{{ $article->id }}</td>
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800 max-w-xs truncate">
                                {{ $article->title_uz ?: $article->title_en }}</div>
                            <div class="text-xs text-gray-400">{{ $article->authors_string }}</div>
                        </td>
                        <td class="px-4 py-3 text-gray-500 text-xs">{{ $article->journal->name_uz ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $article->volume }}/{{ $article->issue }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs
                                @if($article->status === 'published') bg-green-50 text-green-700
                                @elseif($article->status === 'accepted') bg-blue-50 text-blue-700
                                @elseif($article->status === 'under_review') bg-yellow-50 text-yellow-700
                                @elseif($article->status === 'rejected') bg-red-50 text-red-700
                                @else bg-gray-50 text-gray-700
                                @endif">{{ $article->status }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-400 text-xs">{{ $article->published_at?->format('d.m.Y') ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.articles.edit', $article) }}"
                                    class="text-navy hover:text-gold text-xs font-medium">Tahrirlash</a>
                                <form method="POST" action="{{ route('admin.articles.destroy', $article) }}"
                                    onsubmit="return confirm('O\'chirishni tasdiqlaysizmi?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 text-xs">O'chirish</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-400">Maqolalar topilmadi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $articles->links() }}</div>
@endsection