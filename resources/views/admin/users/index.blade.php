@extends('admin.layouts.app')
@section('page_title', 'Foydalanuvchilar')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-bold text-gray-800">Foydalanuvchilar</h1>
        <a href="{{ route('admin.users.create') }}"
            class="bg-navy hover:bg-navy-dark text-white text-sm font-medium px-4 py-2 rounded-lg">+ Yangi</a>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-gray-600">
                    <th class="px-4 py-3 font-medium">#</th>
                    <th class="px-4 py-3 font-medium">Ism</th>
                    <th class="px-4 py-3 font-medium">Email</th>
                    <th class="px-4 py-3 font-medium">Rol</th>
                    <th class="px-4 py-3 font-medium">Holat</th>
                    <th class="px-4 py-3 font-medium">Amallar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-400">{{ $user->id }}</td>
                        <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $user->email }}</td>
                        <td class="px-4 py-3"><span
                                class="px-2 py-0.5 rounded-full text-xs bg-blue-50 text-blue-700">{{ $user->role }}</span></td>
                        <td class="px-4 py-3"><span
                                class="px-2 py-0.5 rounded-full text-xs {{ $user->is_active ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">{{ $user->is_active ? 'Aktiv' : 'Nofaol' }}</span>
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}"
                                class="text-navy hover:text-gold text-xs font-medium">Tahrirlash</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                onsubmit="return confirm('O\'chirilsinmi?')">@csrf @method('DELETE')<button
                                    class="text-red-500 text-xs">O'chirish</button></form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">Foydalanuvchilar topilmadi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $users->links() }}</div>
@endsection