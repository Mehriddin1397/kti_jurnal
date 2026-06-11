@extends('admin.layouts.app')
@section('page_title', 'Jurnallar')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Jurnallar</h1>
            <p class="text-sm text-gray-500">Barcha jurnallar ro'yxati</p>
        </div>
        <a href="{{ route('admin.journals.create') }}"
            class="bg-navy hover:bg-navy-dark text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
            + Yangi jurnal
        </a>
    </div>

    {{-- Search --}}
    <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Jurnal nomi bo'yicha qidirish..."
                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">
            <button class="bg-navy text-white text-sm px-4 py-2 rounded-lg">Qidirish</button>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-gray-600">
                    <th class="px-4 py-3 font-medium">#</th>
                    <th class="px-4 py-3 font-medium">Nom</th>
                    <th class="px-4 py-3 font-medium">ISSN</th>
                    <th class="px-4 py-3 font-medium">Maqolalar</th>
                    <th class="px-4 py-3 font-medium">Holat</th>
                    <th class="px-4 py-3 font-medium">Amallar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($journals as $journal)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-400">{{ $journal->id }}</td>
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800">{{ $journal->name_uz }}</div>
                            @if($journal->name_en)
                            <div class="text-xs text-gray-400">{{ $journal->name_en }}</div>@endif
                        </td>
                        <td class="px-4 py-3 text-gray-500 text-xs">
                            @if($journal->issn_print)
                            <div>Print: {{ $journal->issn_print }}</div>@endif
                            @if($journal->issn_online)
                            <div>Online: {{ $journal->issn_online }}</div>@endif
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $journal->articles_count }}</td>
                        <td class="px-4 py-3">
                            <span
                                class="px-2 py-0.5 rounded-full text-xs {{ $journal->status === 'active' ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $journal->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.journals.edit', $journal) }}"
                                    class="text-navy hover:text-gold text-xs font-medium">Tahrirlash</a>
                                <form method="POST" action="{{ route('admin.journals.destroy', $journal) }}"
                                    onsubmit="return confirm('O\'chirishni tasdiqlaysizmi?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 text-xs font-medium">O'chirish</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">Jurnallar topilmadi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $journals->links() }}</div>
@endsection