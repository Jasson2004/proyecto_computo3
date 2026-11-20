<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SDS 26 Green IoT | Blog Semana de Sistemas 2026')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F6F9F6] text-[#0A0F0B] flex flex-col min-h-screen antialiased">
    <!-- Navbar Blanco con Identidad SDS 26 + ASEIS -->
    <header class="bg-white border-b-2 border-[#5EA83A] shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <x-brand-logo size="sm" />
            </a>

            <nav class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-sm font-bold text-[#0A0F0B] hover:text-[#5EA83A] transition">
                    Inicio
                </a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="bg-[#5EA83A] hover:bg-[#4D8F2E] text-white px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm">
                        Panel Admin
                    </a>
                @endif

                <span class="text-xs font-semibold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-full hidden sm:inline">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="button" onclick="openLogoutModal()" class="text-sm font-semibold text-slate-600 hover:text-red-600 transition">
                    Cerrar Sesion
                </button>
                </form>
            </nav>
        </div>
    </header>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-[#5EA83A]/15 border border-[#5EA83A] text-[#234712] px-4 py-3 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-[#0A0F0B] text-slate-400 py-8 mt-16 border-t-4 border-[#5EA83A]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm">
            <div class="flex items-center gap-3">
                <span class="w-2.5 h-2.5 rounded-full bg-[#5EA83A]"></span>
                <p class="text-white font-semibold">SDS 26 Green IoT — ASEIS • UES FMO</p>
            </div>
            <p>Técnicas de Programación para Internet • Laravel 12</p>
        </div>
    </footer>
    <x-logout-modal />
</body>
</html>