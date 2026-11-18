<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Semana de Sistemas 2026 | FMO - UES')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen antialiased">
    <!-- Navbar -->
    <header class="bg-red-900 text-white shadow-md sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-amber-400 text-red-950 font-extrabold flex items-center justify-center text-lg shadow">
                    SS26
                </div>
                <div>
                    <span class="font-bold text-lg tracking-tight block leading-none">Semana de Sistemas 2026</span>
                    <span class="text-xs text-red-200">UES • Facultad Multidisciplinaria Oriental</span>
                </div>
            </a>

            <nav class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-sm font-medium hover:text-amber-300 transition">Inicio</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="bg-amber-400 text-red-950 px-3.5 py-1.5 rounded-lg text-sm font-semibold hover:bg-amber-300 transition">
                            Panel Admin
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-200 hover:text-white underline">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-white/10 hover:bg-white/20 px-4 py-1.5 rounded-lg text-sm font-medium transition">
                        Acceso Equipo
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-slate-400 py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm">
            <p>© 2026 Universidad de El Salvador — Facultad Multidisciplinaria Oriental.</p>
            <p>Técnicas de Programación para Internet • Laravel 12</p>
        </div>
    </footer>
</body>
</html>