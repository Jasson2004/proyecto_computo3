@extends('layouts.public')

@section('content')
<!-- Hero Institucional -->
<section class="bg-gradient-to-br from-red-950 via-red-900 to-slate-900 text-white py-14 border-b border-red-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="inline-block bg-amber-400/20 text-amber-300 border border-amber-400/40 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                Bitácora Oficial de Actividades y Evidencias
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight">
                Crónicas de la Semana de Sistemas 2026
            </h1>
            <p class="mt-4 text-slate-200 text-lg leading-relaxed">
                Registro documentado de ponencias, talleres técnicos, feria de proyectos y actividades de convivencia estudiantil en la Facultad Multidisciplinaria Oriental.
            </p>
        </div>
    </div>
</section>

<!-- Buscador y Filtros por Categoría -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-7">
    <div class="bg-white rounded-xl shadow-md border border-slate-200 p-4 sm:p-6">
        <form action="{{ route('home') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-6">
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Buscar experiencia</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Buscar por tema, ponente, taller o palabra clave..."
                       class="w-full rounded-lg border-slate-300 border px-3.5 py-2 text-sm focus:ring-2 focus:ring-red-800 focus:outline-none">
            </div>
            <div class="md:col-span-4">
                <label class="block text-xs font-semibold uppercase text-slate-500 mb-1">Filtrar por actividad</label>
                <select name="category" class="w-full rounded-lg border-slate-300 border px-3.5 py-2 text-sm focus:ring-2 focus:ring-red-800 focus:outline-none">
                    <option value="">Todas las actividades ({{ $posts->total() }})</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>
                            {{ $cat->name }} ({{ $cat->posts_count }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2 flex items-end gap-2">
                <button type="submit" class="w-full bg-red-900 hover:bg-red-800 text-white font-semibold py-2 px-4 rounded-lg text-sm transition">
                    Filtrar
                </button>
                @if(request()->hasAny(['search', 'category']))
                    <a href="{{ route('home') }}" class="px-3 py-2 text-sm text-slate-600 hover:text-slate-900 border rounded-lg">Limpiar</a>
                @endif
            </div>
        </form>
    </div>
</section>

<!-- Listado Cronológico Inverso -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    @if($posts->isEmpty())
        <div class="bg-white rounded-xl border border-slate-200 p-12 text-center">
            <h2 class="text-lg font-bold text-slate-700">No se encontraron entradas publicadas</h2>
            <p class="text-slate-500 text-sm mt-1">Intenta con otros términos de búsqueda o limpia los filtros activos.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($posts as $post)
                <article class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col hover:shadow-md transition">
                    <a href="{{ route('posts.show', $post->slug) }}" class="block h-48 bg-slate-200 overflow-hidden relative">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-tr from-slate-800 to-red-900 flex items-center justify-center text-white/80 font-bold text-sm px-4 text-center">
                                {{ $post->category->name }}
                            </div>
                        @endif
                        <span class="absolute top-3 left-3 bg-red-900/90 text-white text-xs font-semibold px-2.5 py-1 rounded-md">
                            {{ $post->category->name }}
                        </span>
                    </a>

                    <div class="p-5 flex-grow flex flex-col">
                        <div class="text-xs text-slate-500 flex items-center justify-between mb-2">
                            <span>Actividad: <strong>{{ $post->activity_date->format('d/m/Y') }}</strong></span>
                            <span>{{ $post->images->count() }} evidencias</span>
                        </div>

                        <h2 class="text-lg font-bold text-slate-900 leading-snug mb-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-red-800 transition">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <p class="text-sm text-slate-600 line-clamp-3 mb-4 flex-grow">
                            {{ $post->excerpt }}
                        </p>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="text-slate-500 truncate max-w-[65%]">
                                Por: {{ $post->authors->pluck('name')->join(' & ') }}
                            </span>
                            <a href="{{ route('posts.show', $post->slug) }}" class="font-semibold text-red-800 hover:underline">
                                Leer más →
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @endif
</section>
@endsection