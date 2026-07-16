@extends('admin.layouts.app')
@section('page_title', 'Yangi haqida sahifasi')
@section('content')
    <div class="max-w-4xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-800">Yangi haqida sahifasi</h1>
            <a href="{{ route('admin.about-pages.index') }}" class="text-sm text-gray-500 hover:text-navy">← Orqaga</a>
        </div>
        <form method="POST" action="{{ route('admin.about-pages.store') }}" class="space-y-6">
            @csrf
            @include('admin.about-pages._form')
            <button type="submit" class="bg-navy hover:bg-navy-dark text-white font-medium px-6 py-2.5 rounded-lg">
                Saqlash
            </button>
        </form>
    </div>
@endsection
