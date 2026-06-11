@extends('admin.layouts.app')
@section('page_title', 'Mualliflar')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-bold text-gray-800">Mualliflar</h1>
        <a href="{{ route('admin.authors.create') }}"
            class="bg-navy hover:bg-navy-dark text-white text-sm font-medium px-4 py-2 rounded-lg">+ Yangi muallif</a>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Ism yoki email bo'yicha qidirish..."
                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
            <button class="bg-navy text-white text-sm px-4 py-2 rounded-lg">Qidirish</button>
        </form>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-gray-600">
                    <th class="px-4 py-3 font-medium">#</th>
                    <th class="px-4 py-3 font-medium">Ism</th>
                    <th class="px-4 py-3 font-medium">Tashkilot</th>
                    <th class="px-4 py-3 font-medium">Email</th>
                    <th class="px-4 py-3 font-medium">Maqolalar</th>
                    <th class="px-4 py-3 font-medium">Amallar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $author)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-400">{{ $author->id }}</td>
                        <td class="px-4 py-3 font-medium">{{ $author->full_name }}</td>
                        <td class="px-4 py-3 text-gray-500 text-xs">{{ $author->organization ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-500 text-xs">{{ $author->email ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $author->articles_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.authors.edit', $author) }}"
                                    class="text-navy hover:text-gold text-xs font-medium">Tahrirlash</a>
                                <form method="POST" action="{{ route('admin.authors.destroy', $author) }}"
                                    onsubmit="return confirm('O\'chirilsinmi?')">@csrf @method('DELETE')
                                    <button class="text-red-500 text-xs">O'chirish</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">Mualliflar topilmadi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $authors->links() }}</div>
@endsection