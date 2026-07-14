<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('site.meta.default_title'))</title>
    <meta name="description" content="@yield('meta_description', __('site.meta.default_description'))">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', __('site.footer.brand'))">
    <meta property="og:description" content="@yield('meta_description', __('site.meta.default_description'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    @yield('meta')

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: { DEFAULT: '#1a2f5e', light: '#2a4080', dark: '#0d1b3e' },
                        gold: { DEFAULT: '#c8941a', light: '#e8b84b', pale: '#fdf5e0' },
                        cream: '#faf8f3',
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'Georgia', 'serif'],
                        body: ['"DM Sans"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', system-ui, sans-serif;
        }

        .font-display {
            font-family: 'Playfair Display', Georgia, serif;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-cream text-gray-900 min-h-screen flex flex-col antialiased">

    {{-- HEADER --}}
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50" x-data="{ mobileMenu: false }">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-200 shadow-sm flex-shrink-0">
                        <img src="{{ asset('images/kti-logo.webp') }}" alt="KTI Logo"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="hidden sm:block">
                        <div class="font-display font-bold text-navy text-lg leading-tight">
                            {{ __('site.nav.brand_name') }}
                        </div>
                        <div class="text-xs text-gray-400 -mt-0.5">
                            {{ __('site.nav.brand_subtitle') }}
                        </div>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium text-gray-700 hover:text-navy transition-colors {{ request()->routeIs('home') ? 'text-navy font-semibold' : '' }}">{{ __('site.nav.home') }}</a>
                    <a href="{{ route('journals.index') }}"
                        class="text-sm font-medium text-gray-700 hover:text-navy transition-colors {{ request()->routeIs('journals.*') ? 'text-navy font-semibold' : '' }}">{{ __('site.nav.journals') }}</a>
                    <a href="{{ route('articles.index') }}"
                        class="text-sm font-medium text-gray-700 hover:text-navy transition-colors {{ request()->routeIs('articles.*') ? 'text-navy font-semibold' : '' }}">{{ __('site.nav.articles') }}</a>
                    <a href="{{ route('conferences.index') }}"
                        class="text-sm font-medium text-gray-700 hover:text-navy transition-colors {{ request()->routeIs('conferences.*') ? 'text-navy font-semibold' : '' }}">{{ __('site.nav.conferences') }}</a>
                    <a href="{{ route('news.index') }}"
                        class="text-sm font-medium text-gray-700 hover:text-navy transition-colors {{ request()->routeIs('news.*') ? 'text-navy font-semibold' : '' }}">{{ __('site.nav.news') }}</a>
                </nav>

                <div class="flex items-center gap-4">
                    {{-- Language Switcher (desktop) --}}
                    <div x-data="{ langOpen: false }" class="relative hidden sm:block">
                        <button @click="langOpen = !langOpen"
                            class="flex items-center gap-1 text-sm font-medium text-gray-700 hover:text-navy transition-colors">
                            <span class="uppercase">{{ app()->getLocale() }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="langOpen" @click.away="langOpen = false" x-transition x-cloak
                            class="absolute right-0 mt-2 w-20 bg-white rounded-md shadow-lg border border-gray-100 py-1 z-50">
                            <a href="{{ route('lang.switch', 'uz') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 {{ app()->getLocale() === 'uz' ? 'font-bold text-navy' : '' }}">UZ</a>
                            <a href="{{ route('lang.switch', 'en') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 {{ app()->getLocale() === 'en' ? 'font-bold text-navy' : '' }}">EN</a>
                            <a href="{{ route('lang.switch', 'ru') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 {{ app()->getLocale() === 'ru' ? 'font-bold text-navy' : '' }}">RU</a>
                        </div>
                    </div>

                    {{-- Language Switcher (mobile, always visible) --}}
                    <div x-data="{ langOpenMobile: false }" class="relative sm:hidden">
                        <button @click="langOpenMobile = !langOpenMobile"
                            class="flex items-center gap-1 text-sm font-medium text-gray-700 hover:text-navy transition-colors border border-gray-200 rounded-lg px-2 py-1">
                            <span class="uppercase">{{ app()->getLocale() }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="langOpenMobile" @click.away="langOpenMobile = false" x-transition x-cloak
                            class="absolute right-0 mt-2 w-20 bg-white rounded-md shadow-lg border border-gray-100 py-1 z-50">
                            <a href="{{ route('lang.switch', 'uz') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 {{ app()->getLocale() === 'uz' ? 'font-bold text-navy' : '' }}">UZ</a>
                            <a href="{{ route('lang.switch', 'en') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 {{ app()->getLocale() === 'en' ? 'font-bold text-navy' : '' }}">EN</a>
                            <a href="{{ route('lang.switch', 'ru') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 {{ app()->getLocale() === 'ru' ? 'font-bold text-navy' : '' }}">RU</a>
                        </div>
                    </div>

                    <a href="{{ route('submit.create') }}"
                        class="hidden md:inline-flex items-center gap-1 bg-gold hover:bg-gold-light text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                        📝 {{ __('site.nav.submit') }}
                    </a>
                    <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 text-gray-600 hover:text-navy">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div x-show="mobileMenu" x-transition class="md:hidden pb-4 border-t">
                <a href="{{ route('home') }}" class="block py-2 text-sm text-gray-700 hover:text-navy">{{ __('site.nav.home') }}</a>
                <a href="{{ route('journals.index') }}"
                    class="block py-2 text-sm text-gray-700 hover:text-navy">{{ __('site.nav.journals') }}</a>
                <a href="{{ route('articles.index') }}"
                    class="block py-2 text-sm text-gray-700 hover:text-navy">{{ __('site.nav.articles') }}</a>
                <a href="{{ route('conferences.index') }}"
                    class="block py-2 text-sm text-gray-700 hover:text-navy">{{ __('site.nav.conferences') }}</a>
                <a href="{{ route('news.index') }}"
                    class="block py-2 text-sm text-gray-700 hover:text-navy">{{ __('site.nav.news') }}</a>
                <a href="{{ route('submit.create') }}" class="block py-2 text-sm text-gold font-medium">📝 {{ __('site.nav.submit') }}</a>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-navy-dark text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0">
                            <img src="{{ asset('images/kti-logo.webp') }}" alt="KTI Logo"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="font-display font-bold text-xl">{{ __('site.footer.brand') }}</div>
                    </div>
                    <p class="text-blue-200 text-sm leading-relaxed max-w-md">
                        {{ __('site.footer.description') }}
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-3 text-gold-light">{{ __('site.footer.pages_heading') }}</h4>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li><a href="{{ route('journals.index') }}"
                                class="hover:text-white transition-colors">{{ __('site.nav.journals') }}</a></li>
                        <li><a href="{{ route('articles.index') }}"
                                class="hover:text-white transition-colors">{{ __('site.nav.articles') }}</a></li>
                        <li><a href="{{ route('conferences.index') }}"
                                class="hover:text-white transition-colors">{{ __('site.nav.conferences') }}</a></li>
                        <li><a href="{{ route('submit.create') }}" class="hover:text-white transition-colors">{{ __('site.nav.submit') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-3 text-gold-light">{{ __('site.footer.contact_heading') }}</h4>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li>📧 info@criminology-journal.uz</li>
                        <li>📞 +998 71 123 45 67</li>
                        <li>📍 {{ __('site.footer.address') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-navy-light">
            <div
                class="max-w-7xl mx-auto px-4 py-4 flex flex-col md:flex-row items-center justify-between text-xs text-blue-300">
                <span>© {{ date('Y') }} {{ __('site.footer.copyright_brand') }}. {{ __('site.footer.rights') }}</span>
                <div class="flex items-center gap-4 mt-2 md:mt-0">
                    <span class="bg-navy px-2 py-1 rounded text-gold-light">Google Scholar</span>
                    <span class="bg-navy px-2 py-1 rounded text-gold-light">OAK</span>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>