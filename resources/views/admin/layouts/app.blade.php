<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — Kriminologiya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: { DEFAULT: '#1a2f5e', light: '#2a4080', dark: '#0d1b3e' },
                        gold: { DEFAULT: '#c8941a', light: '#e8b84b', pale: '#fdf5e0' },
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen" x-data="{ sidebarOpen: true }">
    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="w-60 bg-navy-dark text-white flex-shrink-0 flex flex-col fixed h-full z-30"
            :class="sidebarOpen ? '' : '-translate-x-full'" style="transition: transform 0.3s ease">
            <div class="p-5 border-b border-navy">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gold rounded-lg flex items-center justify-center text-sm font-bold">⚖️</div>
                    <span class="font-bold text-lg">Admin</span>
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-navy text-white' : 'text-blue-200 hover:bg-navy hover:text-white' }} transition-colors">
                    📊 <span>Dashboard</span>
                </a>

                <div class="pt-3 pb-1 px-3 text-xs uppercase text-blue-400 tracking-wider">Kontent</div>

                <a href="{{ route('admin.journals.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.journals.*') ? 'bg-navy text-white' : 'text-blue-200 hover:bg-navy hover:text-white' }} transition-colors">
                    📰 <span>Jurnallar</span>
                </a>
                <a href="{{ route('admin.articles.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.articles.*') ? 'bg-navy text-white' : 'text-blue-200 hover:bg-navy hover:text-white' }} transition-colors">
                    📄 <span>Maqolalar</span>
                </a>
                <a href="{{ route('admin.submissions.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.submissions.*') ? 'bg-navy text-white' : 'text-blue-200 hover:bg-navy hover:text-white' }} transition-colors">
                    📩 <span>Yuborilganlar</span>
                </a>
                <a href="{{ route('admin.authors.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.authors.*') ? 'bg-navy text-white' : 'text-blue-200 hover:bg-navy hover:text-white' }} transition-colors">
                    👥 <span>Mualliflar</span>
                </a>
                <a href="{{ route('admin.conferences.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.conferences.*') ? 'bg-navy text-white' : 'text-blue-200 hover:bg-navy hover:text-white' }} transition-colors">
                    📅 <span>Konferensiyalar</span>
                </a>
                <a href="{{ route('admin.news.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.news.*') ? 'bg-navy text-white' : 'text-blue-200 hover:bg-navy hover:text-white' }} transition-colors">
                    📰 <span>Yangiliklar</span>
                </a>
                <a href="{{ route('admin.about-pages.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.about-pages.*') ? 'bg-navy text-white' : 'text-blue-200 hover:bg-navy hover:text-white' }} transition-colors">
                    📋 <span>Haqida sahifalari</span>
                </a>

                <div class="pt-3 pb-1 px-3 text-xs uppercase text-blue-400 tracking-wider">Tizim</div>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.users.*') ? 'bg-navy text-white' : 'text-blue-200 hover:bg-navy hover:text-white' }} transition-colors">
                    👤 <span>Foydalanuvchilar</span>
                </a>
                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.settings.*') ? 'bg-navy text-white' : 'text-blue-200 hover:bg-navy hover:text-white' }} transition-colors">
                    ⚙️ <span>Sozlamalar</span>
                </a>
            </nav>

            <div class="p-4 border-t border-navy">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 text-sm text-blue-300 hover:text-white transition-colors w-full">
                        🚪 <span>Chiqish</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <div class="flex-1 ml-60">
            {{-- TOPBAR --}}
            <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-20">
                <div class="flex items-center justify-between px-6 h-14">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 lg:hidden">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <h2 class="text-sm font-semibold text-gray-700">@yield('page_title', 'Dashboard')</h2>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('home') }}" target="_blank" class="text-sm text-gray-500 hover:text-navy">🌐
                            Saytni ko'rish</a>
                        <span class="text-sm text-gray-600">👤 {{ auth()->user()->name ?? 'Admin' }}</span>
                    </div>
                </div>
            </header>

            {{-- PAGE CONTENT --}}
            <main class="p-6">
                {{-- Flash Messages --}}
                @if(session('success'))
                    <div
                        class="mb-4 bg-green-50 border border-green-200 text-green-700 text-sm rounded-lg p-3 flex items-center gap-2">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div
                        class="mb-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg p-3 flex items-center gap-2">
                        ❌ {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>