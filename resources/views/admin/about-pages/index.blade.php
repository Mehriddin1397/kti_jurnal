@extends('admin.layouts.app')
@section('page_title', 'Haqida sahifalari')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Haqida sahifalari</h1>
            <p class="text-sm text-gray-500 mt-1">Jurnal sahifasidagi dropdown bo'limlari</p>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-gray-600">
                    <th class="px-4 py-3 font-medium">#</th>
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
                            <a href="{{ route('admin.about-pages.edit', $page) }}"
                                class="text-navy hover:text-gold text-xs font-medium">Tahrirlash</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                            Sahifalar topilmadi. <code>php artisan db:seed --class=AboutPageSeeder</code> ni ishga tushiring.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
