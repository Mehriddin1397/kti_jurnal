@extends('admin.layouts.app')
@section('page_title', 'Haqida sahifalari')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Haqida sahifalari</h1>
            <p class="text-sm text-gray-500 mt-1">Har bir jurnal uchun alohida "Haqida" dropdown bo'limlari</p>
        </div>
        <a href="{{ route('admin.about-pages.create') }}"
            class="bg-navy hover:bg-navy-dark text-white text-sm font-medium px-4 py-2 rounded-lg">+ Yangi sahifa</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4">
        <form method="GET" class="flex flex-wrap gap-3">
            <select name="journal_id" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                <option value="">Barcha jurnallar</option>
                @foreach($journals as $j)
                    <option value="{{ $j->id }}" {{ request('journal_id') == $j->id ? 'selected' : '' }}>{{ $j->name_uz }}</option>
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
                    <th class="px-4 py-3 font-medium">Jurnal</th>
                    <th class="px-4 py-3 font-medium">Sarlavha (UZ)</th>
                    <th class="px-4 py-3 font-medium">Slug</th>
                    <th class="px-4 py-3 font-medium">Holat</th>
                    <th class="px-4 py-3 font-medium">Amallar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-400">{{ $page->sort_order }}</td>
                        <td class="px-4 py-3 text-gray-500 text-xs">{{ $page->journal?->name_uz ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <p class="font-medium">{{ $page->title_uz }}</p>
                            @if($page->description_uz)
                                <p class="text-xs text-gray-400 mt-1 line-clamp-2">{{ $page->description_uz }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-400 text-xs">{{ $page->slug }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs {{ $page->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $page->is_active ? 'Faol' : 'Nofaol' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.about-pages.edit', $page) }}"
                                    class="text-navy hover:text-gold text-xs font-medium">Tahrirlash</a>
                                <form method="POST" action="{{ route('admin.about-pages.destroy', $page) }}"
                                    onsubmit="return confirm('O\'chirishni tasdiqlaysizmi?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 text-xs">O'chirish</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                            Sahifalar topilmadi. <code>php artisan db:seed --class=AboutPageSeeder</code> ni ishga tushiring.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
