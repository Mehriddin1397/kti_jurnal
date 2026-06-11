@extends('admin.layouts.app')
@section('page_title', $author->exists ? 'Muallifni tahrirlash' : 'Yangi muallif')
@section('content')
    <div class="max-w-3xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-800">{{ $author->exists ? 'Muallifni tahrirlash' : 'Yangi muallif' }}
            </h1>
            <a href="{{ route('admin.authors.index') }}" class="text-sm text-gray-500 hover:text-navy">← Orqaga</a>
        </div>
        <form method="POST"
            action="{{ $author->exists ? route('admin.authors.update', $author) : route('admin.authors.store') }}"
            enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if($author->exists) @method('PUT') @endif
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Ism *</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $author->first_name) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                        @error('first_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Familiya *</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $author->last_name) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Otasining ismi</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name', $author->middle_name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $author->email) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">ORCID</label>
                        <input type="text" name="orcid" value="{{ old('orcid', $author->orcid) }}"
                            placeholder="0000-0000-0000-0000"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Tashkilot</label>
                        <input type="text" name="organization" value="{{ old('organization', $author->organization) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Mamlakat</label>
                        <input type="text" name="country" value="{{ old('country', $author->country) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">Scopus ID</label>
                        <input type="text" name="scopus_id" value="{{ old('scopus_id', $author->scopus_id) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">WoS ID</label>
                        <input type="text" name="wos_id" value="{{ old('wos_id', $author->wos_id) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Biografiya</label>
                    <textarea name="bio" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ old('bio', $author->bio) }}</textarea>
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Fotosurat</label>
                    <input type="file" name="photo" class="w-full text-sm">
                    @if($author->photo)
                    <p class="text-xs text-gray-400 mt-1">Joriy: {{ $author->photo }}</p>@endif
                </div>
            </div>
            <button type="submit"
                class="bg-navy hover:bg-navy-dark text-white font-medium px-6 py-2.5 rounded-lg">{{ $author->exists ? 'Yangilash' : 'Saqlash' }}</button>
        </form>
    </div>
@endsection