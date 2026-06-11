@extends('admin.layouts.app')
@section('page_title', $user->exists ? 'Foydalanuvchini tahrirlash' : 'Yangi foydalanuvchi')
@section('content')
    <div class="max-w-2xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-800">{{ $user->exists ? 'Tahrirlash' : 'Yangi foydalanuvchi' }}</h1>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:text-navy">← Orqaga</a>
        </div>
        <form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}"
            class="space-y-6">
            @csrf @if($user->exists) @method('PUT') @endif
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Ism *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">@error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">@error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Parol
                        {{ $user->exists ? '(bo\'sh qoldiring agar o\'zgartirmaysiz)' : '*' }}</label>
                    <input type="password" name="password" {{ $user->exists ? '' : 'required' }}
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">@error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Rol *</label>
                    <select name="role" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        @foreach(['superadmin' => 'Super Admin', 'admin' => 'Admin', 'editor' => 'Muharrir', 'reviewer' => 'Taqrizchi'] as $v => $l)
                            <option value="{{ $v }}" {{ old('role', $user->role) === $v ? 'selected' : '' }}>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }} class="rounded"> Aktiv</label>
            </div>
            <button type="submit"
                class="bg-navy hover:bg-navy-dark text-white font-medium px-6 py-2.5 rounded-lg">{{ $user->exists ? 'Yangilash' : 'Saqlash' }}</button>
        </form>
    </div>
@endsection