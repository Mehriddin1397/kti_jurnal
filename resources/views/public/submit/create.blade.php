@extends('public.layouts.app')
@section('title', 'Maqola yuborish — Kriminologiya')
@section('content')
    <div class="max-w-3xl mx-auto px-4 py-12">
        <h1 class="font-display text-3xl font-bold text-navy-dark mb-2">Maqola yuborish</h1>
        <p class="text-gray-600 mb-8">Maqola yuboring va ekspertlar tomonidan ko'rib chiqilishi va nashr etilishi jarayonini
            boshlang.</p>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 mb-6">
                ✅ {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('submit.store') }}" enctype="multipart/form-data" class="space-y-6"
            x-data="submitForm()">
            @csrf

            <div class="bg-white rounded-xl border p-6 space-y-4">
                <h3 class="font-semibold text-navy-dark border-b pb-2">Maqola ma'lumotlari</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Maqola sarlavhasi *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Jurnal *</label>
                        <select name="journal_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                            <option value="">Tanlang</option>
                            @foreach($journals as $j)
                                <option value="{{ $j->id }}" {{ old('journal_id') == $j->id ? 'selected' : '' }}>{{ $j->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('journal_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Maqola turi</label>
                        <select name="article_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            @foreach(['research' => 'Tadqiqot maqolasi', 'review' => 'Sharh maqolasi', 'case_study' => 'Amaliy tadqiqot', 'conference' => 'Konferensiya maqolasi', 'short_comm' => 'Qisqa xabar'] as $v => $l)
                                <option value="{{ $v }}" {{ old('article_type') === $v ? 'selected' : '' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Til</label>
                        <select name="language" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            @foreach(['uz' => 'O\'zbek', 'en' => 'English', 'ru' => 'Русский'] as $v => $l)
                                <option value="{{ $v }}" {{ old('language', 'uz') === $v ? 'selected' : '' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">PDF fayl *</label>
                        <input type="file" name="pdf_file" accept=".pdf" required class="w-full text-sm">
                        @error('pdf_file')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Annotatsiya (abstract) *</label>
                    <textarea name="abstract" rows="4" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old('abstract') }}</textarea>
                    @error('abstract')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Kalit so'zlar</label>
                    <input type="text" name="keywords" value="{{ old('keywords') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none"
                        placeholder="vergul bilan ajrating">
                </div>
            </div>

            <div class="bg-white rounded-xl border p-6 space-y-4">
                <h3 class="font-semibold text-navy-dark border-b pb-2">Mualliflar</h3>
                <template x-for="(author, i) in authors" :key="i">
                    <div class="p-4 bg-gray-50 rounded-lg space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600" x-text="'Muallif ' + (i+1)"></span>
                            <button type="button" @click="authors.splice(i,1)" x-show="authors.length > 1"
                                class="text-red-500 text-sm">✕ O'chirish</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <input type="text" :name="'authors['+i+'][first_name]'" x-model="author.first_name"
                                placeholder="Ism *" required
                                class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                            <input type="text" :name="'authors['+i+'][last_name]'" x-model="author.last_name"
                                placeholder="Familiya *" required
                                class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                            <input type="email" :name="'authors['+i+'][email]'" x-model="author.email" placeholder="Email *"
                                required
                                class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <input type="text" :name="'authors['+i+'][organization]'" x-model="author.organization"
                                placeholder="Tashkilot"
                                class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                            <label class="flex items-center gap-2 text-sm text-gray-600">
                                <input type="radio" name="corresponding_author" :value="i" class="text-navy"> Asosiy muallif
                            </label>
                        </div>
                    </div>
                </template>
                <button type="button" @click="authors.push({first_name:'',last_name:'',email:'',organization:''})"
                    class="text-sm text-navy hover:text-gold font-medium">+ Muallif qo'shish</button>
            </div>

            <div class="bg-gold-pale rounded-xl border border-gold p-6">
                <label class="flex items-start gap-3 text-sm">
                    <input type="checkbox" name="agreement" required class="mt-1 rounded">
                    <span class="text-gray-700">Men maqolam original ekanligini va boshqa jurnallarga yuborilmaganligini
                        tasdiqlayman. Men jurnal siyosatiga rozilik bildiraman. *</span>
                </label>
            </div>

            <button type="submit"
                class="w-full bg-navy hover:bg-navy-dark text-white font-semibold py-3 rounded-lg transition-colors">📤
                Maqolani yuborish</button>
        </form>
    </div>

    <script>
        function submitForm() {
            return {
                authors: [{ first_name: '', last_name: '', email: '', organization: '' }]
            }
        }
    </script>
@endsection