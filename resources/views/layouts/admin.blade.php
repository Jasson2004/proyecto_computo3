<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Administrativo') | SDS 26 Green IoT</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F6F9F6] text-[#0A0F0B] min-h-screen flex">

    <!-- Fondo oscuro (Backdrop) al abrir el menú en teléfono -->
    <div id="mobile-backdrop" onclick="toggleAdminMenu()"
         class="fixed inset-0 bg-black/60 z-40 hidden md:hidden transition-opacity"></div>

    <!-- Menú Lateral (Deslizable en teléfono, fijo en escritorio) -->
    <aside id="admin-sidebar"
           class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0A0F0B] text-slate-200 flex flex-col border-r border-slate-800 transform -translate-x-full md:translate-x-0 md:static md:flex-shrink-0 transition-transform duration-200 ease-in-out">
        
        <div class="p-4 border-b border-slate-800 bg-white/5 flex items-center justify-between md:justify-center">
            <x-brand-logo :dark="true" size="sm" />
            <button type="button" onclick="toggleAdminMenu()" class="md:hidden text-slate-400 hover:text-white p-1.5 text-lg font-bold">
                ✕
            </button>
        </div>

        <nav class="p-4 space-y-1.5 flex-grow text-sm overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-3.5 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#5EA83A] text-white shadow' : 'hover:bg-white/10 text-slate-300' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.posts.create') }}"
               class="block px-3.5 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.posts.create') ? 'bg-[#5EA83A] text-white shadow' : 'hover:bg-white/10 text-slate-300' }}">
                + Nueva Entrada
            </a>
            <a href="{{ route('admin.posts.index') }}"
               class="block px-3.5 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.posts.index') ? 'bg-[#5EA83A] text-white shadow' : 'hover:bg-white/10 text-slate-300' }}">
                Publicaciones
            </a>
            <a href="{{ route('admin.posts.drafts') }}"
               class="block px-3.5 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.posts.drafts') ? 'bg-[#5EA83A] text-white shadow' : 'hover:bg-white/10 text-slate-300' }}">
                Borradores
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="block px-3.5 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.categories.*') ? 'bg-[#5EA83A] text-white shadow' : 'hover:bg-white/10 text-slate-300' }}">
                Categorías
            </a>
            <a href="{{ route('admin.users.index') }}"
               class="block px-3.5 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.users.*') ? 'bg-[#5EA83A] text-white shadow' : 'hover:bg-white/10 text-slate-300' }}">
                Usuarios y Roles
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800 text-xs text-slate-400">
            <a href="{{ route('home') }}" class="text-[#7ED356] font-bold hover:underline block mb-3">
                ← Volver al Blog Público
            </a>
            <div class="font-semibold text-white truncate">{{ auth()->user()->name }}</div>
            <div class="truncate">{{ auth()->user()->email }}</div>
        </div>
    </aside>

    <!-- Contenedor Principal -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Barra Superior -->
        <header class="bg-white border-b border-slate-200 h-16 px-4 sm:px-6 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-3 min-w-0">
                <!-- Botón Hamburguesa (Solo visible en teléfono) -->
                <button type="button" onclick="toggleAdminMenu()"
                        class="md:hidden inline-flex items-center justify-center p-2 rounded-xl border border-slate-200 text-[#0A0F0B] hover:bg-slate-100 focus:outline-none"
                        aria-label="Abrir menú">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="font-extrabold text-[#0A0F0B] truncate text-sm sm:text-base">
                    @yield('header', 'Administración')
                </div>
            </div>

            <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                <span class="hidden sm:inline-block text-xs bg-[#5EA83A]/15 border border-[#5EA83A]/40 px-3 py-1 rounded-full font-bold text-[#2E5B18]">
                    Rol: Administrador
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="button" onclick="openLogoutModal()" class="text-xs sm:text-sm text-slate-600 hover:text-red-600 font-bold">
                    Cerrar Sesión
                    </button>
                </form>
            </div>
        </header>

        <main class="p-4 sm:p-6 max-w-7xl w-full mx-auto flex-grow">
            @if(session('success'))
                <div class="mb-5 bg-[#5EA83A]/15 border border-[#5EA83A] text-[#234712] px-4 py-3 rounded-xl text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-5 bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-xl text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        function toggleAdminMenu() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('mobile-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }
    </script>
    <x-logout-modal />
</body>
</html>