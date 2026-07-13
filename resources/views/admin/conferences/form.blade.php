@extends('admin.layouts.app')
@section('page_title', $conference->exists ? 'Konferensiyani tahrirlash' : 'Yangi konferensiya')
@section('content')
    <div class="max-w-3xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-800">{{ $conference->exists ? 'Tahrirlash' : 'Yangi konferensiya' }}</h1>
            <a href="{{ route('admin.conferences.index') }}" class="text-sm text-gray-500 hover:text-navy">← Orqaga</a>
        </div>
        <form method="POST"
            action="{{ $conference->exists ? route('admin.conferences.update', $conference) : route('admin.conferences.store') }}"
            enctype="multipart/form-data" class="space-y-6">
            @csrf @if($conference->exists) @method('PUT') @endif
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Nom (UZ) *</label>
                        <input type="text" name="title_uz" value="{{ old('title_uz', $conference->title_uz) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">@error('title_uz')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Nom (EN)</label>
                        <input type="text" name="title_en" value="{{ old('title_en', $conference->title_en) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $conference->slug) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none"
                        placeholder="avtomatik">
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Boshlanish</label>
                        <input type="date" name="start_date"
                            value="{{ old('start_date', $conference->start_date?->format('Y-m-d')) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Tugash</label>
                        <input type="date" name="end_date"
                            value="{{ old('end_date', $conference->end_date?->format('Y-m-d')) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Maqola muddati</label>
                        <input type="date" name="submission_deadline"
                            value="{{ old('submission_deadline', $conference->submission_deadline?->format('Y-m-d')) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Ro'yxat muddati</label>
                        <input type="date" name="registration_deadline"
                            value="{{ old('registration_deadline', $conference->registration_deadline?->format('Y-m-d')) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Joy</label>
                        <input type="text" name="venue" value="{{ old('venue', $conference->venue) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Holat</label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            @foreach(['upcoming' => 'Kutilmoqda', 'active' => 'Aktiv', 'closed' => 'Yopilgan', 'archived' => 'Arxiv'] as $v => $l)
                                <option value="{{ $v }}" {{ old('status', $conference->status) === $v ? 'selected' : '' }}>
                                    {{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_online" value="1" {{ old('is_online', $conference->is_online) ? 'checked' : '' }} class="rounded"> Online</label>
                @foreach(['description_uz' => 'Tavsif (UZ)', 'description_en' => 'Tavsif (EN)', 'topics' => 'Mavzular'] as $f => $l)
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">{{ $l }}</label>
                        <textarea name="{{ $f }}" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old($f, $conference->$f) }}</textarea>
                    </div>
                @endforeach
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Muqova rasmi</label>
                    <input type="file" name="cover_image" class="w-full text-sm">
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">To'plam (PDF arxivi, max 30MB)</label>
                    <input type="file" name="pdf_file" accept=".pdf" class="w-full text-sm">
                    @if($conference->pdf_file)
                        <p class="text-xs text-navy mt-1"><a href="{{ $conference->pdf_url }}" target="_blank">Mavjud faylni ko'rish</a></p>
                    @endif
                </div>
            </div>
            <button type="submit"
                class="bg-navy hover:bg-navy-dark text-white font-medium px-6 py-2.5 rounded-lg">{{ $conference->exists ? 'Yangilash' : 'Saqlash' }}</button>
        </form>
    </div>
@endsection