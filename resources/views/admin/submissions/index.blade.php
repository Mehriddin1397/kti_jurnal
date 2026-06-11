@extends('admin.layouts.app')
@section('page_title', 'Yuborilgan maqolalar')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-bold text-gray-800">Yuborilgan maqolalar</h1>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-gray-600">
                    <th class="px-4 py-3 font-medium">#</th>
                    <th class="px-4 py-3 font-medium">Sarlavha</th>
                    <th class="px-4 py-3 font-medium">Muallif</th>
                    <th class="px-4 py-3 font-medium">Jurnal</th>
                    <th class="px-4 py-3 font-medium">Sana</th>
                    <th class="px-4 py-3 font-medium">Holat</th>
                    <th class="px-4 py-3 font-medium">Amallar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($submissions as $sub)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-400">{{ $sub->id }}</td>
                        <td class="px-4 py-3 font-medium text-gray-800 max-w-xs truncate">{{ $sub->title }}</td>
                        <td class="px-4 py-3 text-gray-500 text-xs">{{ $sub->authors->first()?->full_name ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-500 text-xs">{{ $sub->journal->name_uz ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-400 text-xs">{{ $sub->created_at->format('d.m.Y') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs
                                @if($sub->status === 'accepted') bg-green-50 text-green-700
                                @elseif($sub->status === 'under_review') bg-yellow-50 text-yellow-700
                                @elseif($sub->status === 'rejected') bg-red-50 text-red-700
                                @else bg-gray-50 text-gray-700 @endif">{{ $sub->status }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.submissions.show', $sub->id) }}"
                                class="text-navy hover:text-gold text-xs font-medium">Ko'rish</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-400">Yuborilgan maqolalar yo'q</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $submissions->links() }}</div>
@endsection