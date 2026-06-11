@php $j = $journal ?? new \App\Models\Journal(); @endphp

<div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
    <h3 class="font-semibold text-gray-700 border-b pb-2">Asosiy ma'lumotlar</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Nom (UZ) *</label>
            <input type="text" name="name_uz" value="{{ old('name_uz', $j->name_uz) }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">
            @error('name_uz')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Nom (EN)</label>
            <input type="text" name="name_en" value="{{ old('name_en', $j->name_en) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Nom (RU)</label>
            <input type="text" name="name_ru" value="{{ old('name_ru', $j->name_ru) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $j->slug) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none"
                placeholder="avtomatik yaratiladi">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">ISSN (Print)</label>
            <input type="text" name="issn_print" value="{{ old('issn_print', $j->issn_print) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">ISSN (Online)</label>
            <input type="text" name="issn_online" value="{{ old('issn_online', $j->issn_online) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Bosh muharrir</label>
            <input type="text" name="chief_editor" value="{{ old('chief_editor', $j->chief_editor) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Muharrir unvoni</label>
            <input type="text" name="chief_editor_title" value="{{ old('chief_editor_title', $j->chief_editor_title) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Tashkil etilgan yil</label>
            <input type="number" name="founding_year" value="{{ old('founding_year', $j->founding_year) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Nashr chastotasi</label>
            <select name="frequency"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">
                @foreach(['monthly' => 'Oylik', 'quarterly' => 'Choraklik', 'biannual' => 'Yarim yillik', 'annual' => 'Yillik'] as $val => $lbl)
                    <option value="{{ $val }}" {{ old('frequency', $j->frequency) === $val ? 'selected' : '' }}>{{ $lbl }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Holat</label>
            <select name="status"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">
                <option value="active" {{ old('status', $j->status) === 'active' ? 'selected' : '' }}>Aktiv</option>
                <option value="inactive" {{ old('status', $j->status) === 'inactive' ? 'selected' : '' }}>Nofaol</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Yuborish email</label>
            <input type="email" name="submission_email" value="{{ old('submission_email', $j->submission_email) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">
        </div>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Muqova rasmi</label>
        <input type="file" name="cover_image" class="w-full text-sm">
        @if($j->cover_image)
            <p class="text-xs text-gray-400 mt-1">Joriy: {{ $j->cover_image }}</p>
        @endif
    </div>
</div>

<div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
    <h3 class="font-semibold text-gray-700 border-b pb-2">Tavsiflar</h3>
    @foreach(['description_uz' => 'Tavsif (UZ)', 'description_en' => 'Tavsif (EN)', 'description_ru' => 'Tavsif (RU)'] as $field => $label)
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">{{ $label }}</label>
            <textarea name="{{ $field }}" rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">{{ old($field, $j->$field) }}</textarea>
        </div>
    @endforeach
</div>

<div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
    <h3 class="font-semibold text-gray-700 border-b pb-2">Siyosatlar</h3>
    @foreach(['aims_and_scope' => 'Maqsad va qamrov', 'peer_review_policy' => 'Peer review siyosati', 'author_guidelines' => 'Muallif ko\'rsatmalari', 'ethics_policy' => 'Etika siyosati'] as $field => $label)
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">{{ $label }}</label>
            <textarea name="{{ $field }}" rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy focus:border-navy outline-none">{{ old($field, $j->$field) }}</textarea>
        </div>
    @endforeach
</div>

<div class="bg-white rounded-xl border border-gray-200 p-6">
    <h3 class="font-semibold text-gray-700 border-b pb-2 mb-4">Indekslash</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach(['is_indexed_google_scholar' => 'Google Scholar', 'is_indexed_hak' => 'OAK (HAK)', 'is_indexed_inlibrary' => 'inLibrary', 'is_indexed_scopus' => 'Scopus'] as $field => $label)
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="{{ $field }}" value="1" {{ old($field, $j->$field) ? 'checked' : '' }}
                    class="rounded">
                {{ $label }}
            </label>
        @endforeach
    </div>
</div>