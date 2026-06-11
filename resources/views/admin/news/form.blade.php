@extends('admin.layouts.app')
@section('page_title', $newsItem->exists ? 'Yangilikni tahrirlash' : 'Yangi yangilik')
@section('content')
    <div class="max-w-3xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-800">{{ $newsItem->exists ? 'Tahrirlash' : 'Yangi yangilik' }}</h1>
            <a href="{{ route('admin.news.index') }}" class="text-sm text-gray-500 hover:text-navy">← Orqaga</a>
        </div>
        <form method="POST"
            action="{{ $newsItem->exists ? route('admin.news.update', $newsItem) : route('admin.news.store') }}"
            enctype="multipart/form-data" class="space-y-6">
            @csrf @if($newsItem->exists) @method('PUT') @endif
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Sarlavha (UZ) *</label>
                        <input type="text" name="title_uz" value="{{ old('title_uz', $newsItem->title_uz) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">@error('title_uz')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Sarlavha (EN)</label>
                        <input type="text" name="title_en" value="{{ old('title_en', $newsItem->title_en) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $newsItem->slug) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none"
                        placeholder="avtomatik">
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Qisqa ta'rif</label>
                    <textarea name="excerpt" rows="2"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old('excerpt', $newsItem->excerpt) }}</textarea>
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Matn (UZ)</label>
                    <textarea name="body_uz" rows="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old('body_uz', $newsItem->body_uz) }}</textarea>
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Matn (EN)</label>
                    <textarea name="body_en" rows="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old('body_en', $newsItem->body_en) }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Chop etilgan sana</label>
                        <input type="date" name="published_at"
                            value="{{ old('published_at', $newsItem->published_at?->format('Y-m-d')) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Holat</label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            <option value="draft" {{ old('status', $newsItem->status) === 'draft' ? 'selected' : '' }}>
                                Qoralama</option>
                            <option value="published" {{ old('status', $newsItem->status) === 'published' ? 'selected' : '' }}>Chop etilgan</option>
                        </select>
                    </div>
                </div>
                <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $newsItem->is_featured) ? 'checked' : '' }} class="rounded"> Bosh sahifada
                    ko'rsatish</label>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Muqova rasmi</label>
                    <input type="file" name="cover_image" class="w-full text-sm">
                    @if($newsItem->cover_image)
                    <p class="text-xs text-gray-400 mt-1">Joriy: {{ $newsItem->cover_image }}</p>@endif
                </div>
            </div>
            <button type="submit"
                class="bg-navy hover:bg-navy-dark text-white font-medium px-6 py-2.5 rounded-lg">{{ $newsItem->exists ? 'Yangilash' : 'Saqlash' }}</button>
        </form>
    </div>
@endsection