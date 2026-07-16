@extends('admin.layouts.app')
@section('page_title', 'Haqida sahifasini tahrirlash')
@section('content')
    <div class="max-w-4xl">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-bold text-gray-800">{{ $page->title_uz }}</h1>
                <p class="text-sm text-gray-400 mt-1">{{ $page->journal?->name_uz }} · {{ $page->slug }}</p>
            </div>
            <a href="{{ route('admin.about-pages.index') }}" class="text-sm text-gray-500 hover:text-navy">← Orqaga</a>
        </div>
        <form method="POST" action="{{ route('admin.about-pages.update', $page) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.about-pages._form')
            <button type="submit" class="bg-navy hover:bg-navy-dark text-white font-medium px-6 py-2.5 rounded-lg">
                Yangilash
            </button>
        </form>
    </div>
@endsection
