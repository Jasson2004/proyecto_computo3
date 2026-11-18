<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Administrativo') | SS26</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex">
    <!-- Menú Lateral -->
    <aside class="w-64 bg-slate-900 text-slate-200 flex-shrink-0 hidden md:flex flex-col">
        <div class="p-5 border-b border-slate-800">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Admin Panel</span>
            <h1 class="text-lg font-extrabold text-white mt-0.5">Sistemas 2026</h1>
        </div>

        <nav class="p-4 space-y-1.5 flex-grow text-sm">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-3.5 py-2.5 rounded-lg font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-red-800 text-white' : 'hover:bg-slate-800' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.posts.create') }}"
               class="block px-3.5 py-2.5 rounded-lg font-medium {{ request()->routeIs('admin.posts.create') ? 'bg-red-800 text-white' : 'hover:bg-slate-800' }}">
                + Nueva Entrada
            </a>
            <a href="{{ route('admin.posts.index') }}"
               class="block px-3.5 py-2.5 rounded-lg font-medium {{ request()->routeIs('admin.posts.index') ? 'bg-red-800 text-white' : 'hover:bg-slate-800' }}">
                Publicaciones
            </a>
            <a href="{{ route('admin.posts.drafts') }}"
               class="block px-3.5 py-2.5 rounded-lg font-medium {{ request()->routeIs('admin.posts.drafts') ? 'bg-red-800 text-white' : 'hover:bg-slate-800' }}">
                Borradores
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="block px-3.5 py-2.5 rounded-lg font-medium {{ request()->routeIs('admin.categories.*') ? 'bg-red-800 text-white' : 'hover:bg-slate-800' }}">
                Categorías
            </a>
            <a href="{{ route('admin.users.index') }}"
               class="block px-3.5 py-2.5 rounded-lg font-medium {{ request()->routeIs('admin.users.*') ? 'bg-red-800 text-white' : 'hover:bg-slate-800' }}">
                Usuarios y Roles
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800 text-xs text-slate-400">
            <a href="{{ route('home') }}" class="text-amber-400 hover:underline block mb-3">
                Ver Blog Público ↗
            </a>
            <div class="font-semibold text-white">{{ auth()->user()->name }}</div>
            <div class="truncate">{{ auth()->user()->email }}</div>
        </div>
    </aside>

    <!-- Contenedor Principal -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Barra Superior -->
        <header class="bg-white border-b border-slate-200 h-16 px-6 flex items-center justify-between">
            <div class="font-bold text-slate-700">@yield('header', 'Administración')</div>
            <div class="flex items-center gap-4">
                <span class="text-xs bg-slate-100 border px-2.5 py-1 rounded-full font-semibold text-slate-700">
                    Rol: Administrador
                </span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-red-700 hover:text-red-900 font-semibold">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </header>

        <main class="p-6 max-w-7xl w-full mx-auto flex-grow">
            @if(session('success'))
                <div class="mb-5 bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-lg text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-5 bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-lg text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>