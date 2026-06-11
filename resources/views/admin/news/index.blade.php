@extends('admin.layouts.app')
@section('page_title', 'Yangiliklar')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-bold text-gray-800">Yangiliklar</h1>
        <a href="{{ route('admin.news.create') }}"
            class="bg-navy hover:bg-navy-dark text-white text-sm font-medium px-4 py-2 rounded-lg">+ Yangi post</a>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-gray-600">
                    <th class="px-4 py-3 font-medium">#</th>
                    <th class="px-4 py-3 font-medium">Sarlavha</th>
                    <th class="px-4 py-3 font-medium">Holat</th>
                    <th class="px-4 py-3 font-medium">Sana</th>
                    <th class="px-4 py-3 font-medium">Amallar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $item)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-400">{{ $item->id }}</td>
                        <td class="px-4 py-3 font-medium">{{ $item->title_uz }} @if($item->is_featured)<span
                        class="text-gold text-xs">⭐</span>@endif</td>
                        <td class="px-4 py-3"><span
                                class="px-2 py-0.5 rounded-full text-xs {{ $item->status === 'published' ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-600' }}">{{ $item->status }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-400 text-xs">{{ $item->published_at?->format('d.m.Y') ?? '—' }}</td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('admin.news.edit', $item) }}"
                                class="text-navy hover:text-gold text-xs font-medium">Tahrirlash</a>
                            <form method="POST" action="{{ route('admin.news.destroy', $item) }}"
                                onsubmit="return confirm('O\'chirilsinmi?')">@csrf @method('DELETE')<button
                                    class="text-red-500 text-xs">O'chirish</button></form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-400">Yangiliklar topilmadi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $news->links() }}</div>
@endsection