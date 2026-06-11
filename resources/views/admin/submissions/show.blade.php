@extends('admin.layouts.app')
@section('page_title', 'Yuborilgan maqola')
@section('content')
    <div class="max-w-4xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-800">Yuborilgan maqola #{{ $submission->id }}</h1>
            <a href="{{ route('admin.submissions.index') }}" class="text-sm text-gray-500 hover:text-navy">← Orqaga</a>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">{{ $submission->title }}</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Jurnal:</span> <span
                        class="font-medium">{{ $submission->journal->name_uz ?? '—' }}</span></div>
                <div><span class="text-gray-500">Turi:</span> {{ $submission->article_type ?? '—' }}</div>
                <div><span class="text-gray-500">Til:</span> {{ $submission->language ?? '—' }}</div>
                <div><span class="text-gray-500">Holat:</span>
                    <span class="px-2 py-0.5 rounded-full text-xs
                        @if($submission->status === 'accepted') bg-green-50 text-green-700
                        @elseif($submission->status === 'under_review') bg-yellow-50 text-yellow-700
                        @elseif($submission->status === 'rejected') bg-red-50 text-red-700
                        @else bg-gray-50 text-gray-700 @endif">{{ $submission->status }}</span>
                </div>
            </div>
            @if($submission->abstract)
                <div class="mt-4">
                    <h4 class="text-sm font-semibold text-gray-600 mb-1">Annotatsiya</h4>
                    <p class="text-sm text-gray-700">{{ $submission->abstract }}</p>
                </div>
            @endif
            @if($submission->keywords)
                <div class="mt-2">
                    <span class="text-sm text-gray-500">Kalit so'zlar:</span>
                    <span class="text-sm">{{ $submission->keywords }}</span>
                </div>
            @endif
            @if($submission->pdf_file)
                <div class="mt-4">
                    <a href="{{ Storage::disk('public')->url($submission->pdf_file) }}" target="_blank"
                        class="text-sm text-navy hover:text-gold font-medium">📥 PDF ni yuklab olish</a>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
            <h3 class="font-semibold text-gray-700 mb-3">Mualliflar</h3>
            @foreach($submission->authors as $author)
                <div class="p-3 bg-gray-50 rounded-lg mb-2 text-sm">
                    <span class="font-medium">{{ $author->full_name }}</span>
                    @if($author->is_corresponding) <span class="text-xs text-gold">(asosiy muallif)</span> @endif
                    <br><span class="text-gray-500">{{ $author->organization }} · {{ $author->email }}</span>
                </div>
            @endforeach
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-700 mb-3">Holatni o'zgartirish</h3>
            <form method="POST" action="{{ route('admin.submissions.status', $submission->id) }}">
                @csrf @method('PATCH')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Holat</label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            @foreach(['pending' => 'Kutilmoqda', 'under_review' => 'Ko\'rib chiqilmoqda', 'accepted' => 'Qabul qilingan', 'revision' => 'Qayta ishlash', 'rejected' => 'Rad etilgan'] as $v => $l)
                                <option value="{{ $v }}" {{ $submission->status === $v ? 'selected' : '' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Muharrir izohi</label>
                    <textarea name="reviewer_notes" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">{{ $submission->reviewer_notes }}</textarea>
                </div>
                <button type="submit"
                    class="bg-navy hover:bg-navy-dark text-white text-sm font-medium px-4 py-2 rounded-lg">Saqlash</button>
            </form>
        </div>
    </div>
@endsection