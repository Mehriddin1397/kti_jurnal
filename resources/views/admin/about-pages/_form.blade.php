@php $p = $page ?? new \App\Models\AboutPage(); @endphp

<div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
    <h2 class="font-semibold text-gray-800">Asosiy ma'lumotlar</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Jurnal *</label>
            <select name="journal_id" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                <option value="">Tanlang</option>
                @foreach($journals as $j)
                    <option value="{{ $j->id }}" {{ (int) old('journal_id', $p->journal_id) === $j->id ? 'selected' : '' }}>{{ $j->name_uz }}</option>
                @endforeach
            </select>
            @error('journal_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Slug *</label>
            <input type="text" name="slug" value="{{ old('slug', $p->slug) }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
            @error('slug')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
    </div>
</div>

<div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
    <h2 class="font-semibold text-gray-800">Sarlavhalar</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Sarlavha (UZ) *</label>
            <input type="text" name="title_uz" value="{{ old('title_uz', $p->title_uz) }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
            @error('title_uz')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Sarlavha (EN)</label>
            <input type="text" name="title_en" value="{{ old('title_en', $p->title_en) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Sarlavha (RU)</label>
            <input type="text" name="title_ru" value="{{ old('title_ru', $p->title_ru) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
        </div>
    </div>
</div>

<div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
    <h2 class="font-semibold text-gray-800">Qisqa tavsiflar (dropdown uchun)</h2>
    <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Tavsif (UZ)</label>
        <textarea name="description_uz" rows="2"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old('description_uz', $p->description_uz) }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Tavsif (EN)</label>
        <textarea name="description_en" rows="2"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old('description_en', $p->description_en) }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Tavsif (RU)</label>
        <textarea name="description_ru" rows="2"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old('description_ru', $p->description_ru) }}</textarea>
    </div>
</div>

<div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
    <h2 class="font-semibold text-gray-800">To'liq matn</h2>
    <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Matn (UZ)</label>
        <textarea name="body_uz" rows="8"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old('body_uz', $p->body_uz) }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Matn (EN)</label>
        <textarea name="body_en" rows="8"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old('body_en', $p->body_en) }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Matn (RU)</label>
        <textarea name="body_ru" rows="8"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old('body_ru', $p->body_ru) }}</textarea>
    </div>
</div>

<div class="bg-white rounded-xl border border-gray-200 p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Tartib raqami</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $p->sort_order) }}" min="0"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
        </div>
        <div class="flex items-end">
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $p->exists ? $p->is_active : true) ? 'checked' : '' }} class="rounded">
                Dropdownda ko'rsatish
            </label>
        </div>
    </div>
</div>
