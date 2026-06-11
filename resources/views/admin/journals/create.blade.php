@extends('admin.layouts.app')
@section('page_title', 'Yangi jurnal')

@section('content')
    <div class="max-w-4xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-800">Yangi jurnal yaratish</h1>
            <a href="{{ route('admin.journals.index') }}" class="text-sm text-gray-500 hover:text-navy">← Orqaga</a>
        </div>

        <form method="POST" action="{{ route('admin.journals.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @include('admin.journals._form')
            <button type="submit"
                class="bg-navy hover:bg-navy-dark text-white font-medium px-6 py-2.5 rounded-lg transition-colors">Saqlash</button>
        </form>
    </div>
@endsection