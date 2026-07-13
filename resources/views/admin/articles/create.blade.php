@extends('admin.layouts.app')
@section('page_title', 'Yangi maqola')

@section('content')
    <div class="max-w-4xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-800">Yangi maqola</h1>
            <a href="{{ route('admin.articles.index') }}" class="text-sm text-gray-500 hover:text-navy">← Orqaga</a>
        </div>

        <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" class="space-y-6"
            x-data="articleForm()">
            @csrf

            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 border-b pb-2">Sarlavhalar</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach(['title_uz' => 'Sarlavha (UZ) *', 'title_en' => 'Sarlavha (EN)', 'title_ru' => 'Sarlavha (RU)'] as $f => $l)
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">{{ $l }}</label>
                            <input type="text" name="{{ $f }}" value="{{ old($f) }}" {{ $f === 'title_uz' ? 'required' : '' }}
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                            @error($f)<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    @endforeach
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none"
                            placeholder="avtomatik">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Jurnal *</label>
                        <select name="journal_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                            <option value="">Tanlang</option>
                            @foreach($journals as $j)
                                <option value="{{ $j->id }}" {{ old('journal_id') == $j->id ? 'selected' : '' }}>{{ $j->name_uz }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Holat</label>
                        <select name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                            @foreach(['draft' => 'Qoralama', 'under_review' => 'Ko\'rib chiqilmoqda', 'accepted' => 'Qabul qilingan', 'published' => 'Chop etilgan'] as $val => $lbl)
                                <option value="{{ $val }}" {{ old('status') === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Tom</label>
                        <input type="number" name="volume" value="{{ old('volume') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Son</label>
                        <input type="number" name="issue" value="{{ old('issue') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Sahifa (dan)</label>
                        <input type="number" name="page_from" value="{{ old('page_from') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Sahifa (gacha)</label>
                        <input type="number" name="page_to" value="{{ old('page_to') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">DOI</label>
                        <input type="text" name="doi" value="{{ old('doi') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none"
                            placeholder="10.xxxx/xxx">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Til</label>
                        <select name="language"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                            @foreach(['uz' => 'O\'zbek', 'en' => 'English', 'ru' => 'Русский', 'multi' => 'Ko\'p tilli'] as $v => $l)
                                <option value="{{ $v }}" {{ old('language', 'uz') === $v ? 'selected' : '' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Turi</label>
                        <select name="article_type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                            @foreach(['research' => 'Tadqiqot', 'review' => 'Sharh', 'case_study' => 'Amaliy', 'conference' => 'Konferensiya', 'short_comm' => 'Qisqa xabar'] as $v => $l)
                                <option value="{{ $v }}" {{ old('article_type', 'research') === $v ? 'selected' : '' }}>{{ $l }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Chop etilgan sana</label>
                        <input type="date" name="published_at" value="{{ old('published_at') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Qabul qilingan sana</label>
                        <input type="date" name="received_at" value="{{ old('received_at') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Tasdiqlangan sana</label>
                        <input type="date" name="accepted_at" value="{{ old('accepted_at') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                </div>
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="is_open_access" value="1" {{ old('is_open_access', true) ? 'checked' : '' }} class="rounded"> Ochiq kirish (Open Access)
                </label>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 border-b pb-2">Annotatsiyalar</h3>
                @foreach(['abstract_uz' => 'Annotatsiya (UZ)', 'abstract_en' => 'Annotatsiya (EN)', 'abstract_ru' => 'Annotatsiya (RU)'] as $f => $l)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">{{ $l }}</label>
                        <textarea name="{{ $f }}" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old($f) }}</textarea>
                    </div>
                @endforeach
                @foreach(['keywords_uz' => 'Kalit so\'zlar (UZ)', 'keywords_en' => 'Kalit so\'zlar (EN)', 'keywords_ru' => 'Kalit so\'zlar (RU)'] as $f => $l)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">{{ $l }}</label>
                        <input type="text" name="{{ $f }}" value="{{ old($f) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none"
                            placeholder="vergul bilan ajrating">
                    </div>
                @endforeach
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 border-b pb-2">Mualliflar</h3>
                <p class="text-xs text-gray-400">Mavjud mualliflardan tanlang</p>
                <template x-for="(author, index) in selectedAuthors" :key="index">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <select :name="'author_ids['+index+']'"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm" x-model="author.id">
                            <option value="">Muallif tanlang</option>
                            @foreach($authors as $a)
                                <option value="{{ $a->id }}">{{ $a->full_name }} ({{ $a->organization }})</option>
                            @endforeach
                        </select>
                        <label class="flex items-center gap-1 text-xs">
                            <input type="radio" name="corresponding_author" :value="author.id" class="text-sm"> Asosiy
                        </label>
                        <button type="button" @click="selectedAuthors.splice(index, 1)"
                            class="text-red-500 hover:text-red-700 text-sm">✕</button>
                    </div>
                </template>
                <button type="button" @click="selectedAuthors.push({id: ''})"
                    class="text-sm text-navy hover:text-gold font-medium">+ Muallif qo'shish</button>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 border-b pb-2">Fayllar va matn</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">PDF fayl (max 30MB)</label>
                    <input type="file" name="pdf_file" accept=".pdf" class="w-full text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">To'liq matn (HTML)</label>
                    <textarea name="full_text_html" rows="5"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old('full_text_html') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Adabiyotlar (References)</label>
                    <textarea name="references" rows="5"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none"
                        placeholder="HTML formatda">{{ old('references') }}</textarea>
                </div>
            </div>

            <button type="submit"
                class="bg-navy hover:bg-navy-dark text-white font-medium px-6 py-2.5 rounded-lg transition-colors">Saqlash</button>
        </form>
    </div>

    <script>
        function articleForm() {
            return {
                selectedAuthors: [{ id: '' }],
            }
        }
    </script>
@endsection