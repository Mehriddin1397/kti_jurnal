@extends('admin.layouts.app')
@section('page_title', 'Sozlamalar')
@section('content')
    <div class="max-w-4xl">
        <h1 class="text-xl font-bold text-gray-800 mb-6">Sozlamalar</h1>

        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6" x-data="{ tab: 'general' }">
            @csrf

            {{-- Tabs --}}
            <div class="flex gap-2 border-b">
                <button type="button" @click="tab='general'"
                    :class="tab==='general' ? 'border-navy text-navy' : 'border-transparent text-gray-500'"
                    class="px-4 py-2 text-sm font-medium border-b-2 transition-colors">Umumiy</button>
                <button type="button" @click="tab='seo'"
                    :class="tab==='seo' ? 'border-navy text-navy' : 'border-transparent text-gray-500'"
                    class="px-4 py-2 text-sm font-medium border-b-2 transition-colors">SEO</button>
                <button type="button" @click="tab='email'"
                    :class="tab==='email' ? 'border-navy text-navy' : 'border-transparent text-gray-500'"
                    class="px-4 py-2 text-sm font-medium border-b-2 transition-colors">Email</button>
            </div>

            {{-- General --}}
            <div x-show="tab==='general'" class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 border-b pb-2">Umumiy sozlamalar</h3>
                @foreach(['site_name' => 'Sayt nomi', 'site_description' => 'Sayt tavsifi', 'contact_email' => 'Aloqa email', 'contact_phone' => 'Telefon', 'contact_address' => 'Manzil'] as $k => $l)
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">{{ $l }}</label>
                        <input type="text" name="{{ $k }}" value="{{ $settings[$k] ?? '' }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                @endforeach
                @foreach(['social_facebook' => 'Facebook', 'social_telegram' => 'Telegram', 'social_instagram' => 'Instagram'] as $k => $l)
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">{{ $l }} link</label>
                        <input type="url" name="{{ $k }}" value="{{ $settings[$k] ?? '' }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                @endforeach
            </div>

            {{-- SEO --}}
            <div x-show="tab==='seo'" class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 border-b pb-2">SEO sozlamalari</h3>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Meta title template</label>
                    <input type="text" name="meta_title_template" value="{{ $settings['meta_title_template'] ?? '' }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none"
                        placeholder="%page% — Kriminologiya Jurnali">
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Meta description</label>
                    <textarea name="meta_description" rows="2"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">{{ $settings['meta_description'] ?? '' }}</textarea>
                </div>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">Google Analytics ID</label>
                    <input type="text" name="google_analytics_id" value="{{ $settings['google_analytics_id'] ?? '' }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none"
                        placeholder="G-XXXXXXXXXX">
                </div>
            </div>

            {{-- Email --}}
            <div x-show="tab==='email'" class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 border-b pb-2">Email sozlamalari</h3>
                <div><label class="block text-sm font-medium text-gray-600 mb-1">SMTP Host</label>
                    <input type="text" name="smtp_host" value="{{ $settings['smtp_host'] ?? '' }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">SMTP Username</label>
                        <input type="text" name="smtp_username" value="{{ $settings['smtp_username'] ?? '' }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-600 mb-1">SMTP Port</label>
                        <input type="text" name="smtp_port" value="{{ $settings['smtp_port'] ?? '' }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-navy outline-none">
                    </div>
                </div>
            </div>

            <button type="submit"
                class="bg-navy hover:bg-navy-dark text-white font-medium px-6 py-2.5 rounded-lg">Saqlash</button>
        </form>
    </div>
@endsection