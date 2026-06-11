<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Kriminologiya Jurnali</title>
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
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif
        }
    </style>
</head>

<body class="bg-gradient-to-br from-navy-dark via-navy to-navy-light min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white" style="font-family:'Playfair Display',serif">⚖️ Kriminologiya</h1>
            <p class="text-navy-light text-sm mt-1 text-blue-200">Ilmiy jurnal boshqaruv paneli</p>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Tizimga kirish</h2>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg p-3 mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-navy focus:border-navy outline-none transition">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Parol</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-navy focus:border-navy outline-none transition">
                </div>
                <div class="flex items-center mb-6">
                    <input type="checkbox" name="remember" id="remember" class="mr-2 rounded">
                    <label for="remember" class="text-sm text-gray-600">Eslab qolish</label>
                </div>
                <button type="submit"
                    class="w-full bg-navy hover:bg-navy-dark text-white font-semibold py-2.5 rounded-lg transition-colors">
                    Kirish
                </button>
            </form>
        </div>

        <p class="text-center text-blue-200 text-xs mt-6">© {{ date('Y') }} Kriminologiya va Huquq Jurnali</p>
    </div>
</body>

</html>