@extends('layouts.public')

@section('content')
<!-- Hero Institucional Green IoT -->
<section class="bg-gradient-to-br from-[#0A0F0B] via-[#132A15] to-[#0A0F0B] text-white py-14 border-b border-[#5EA83A]/30 relative overflow-hidden">
    <div class="absolute inset-0 opacity-15" style="background-image: radial-gradient(#5EA83A 1.25px, transparent 1.25px); background-size: 26px 26px;"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 bg-[#5EA83A]/20 text-[#86E05B] border border-[#5EA83A]/40 text-xs font-bold uppercase tracking-wider px-3.5 py-1 rounded-full mb-4">
                <span class="w-2 h-2 rounded-full bg-[#5EA83A]"></span>
                Bitácora Oficial • SDS 26 Green IoT
            </span>
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                Crónicas de la <span class="text-[#7ED356]">Semana de Sistemas 2026</span>
            </h1>
            <p class="mt-4 text-slate-300 text-lg leading-relaxed">
                Experiencias académicas, talleres prácticos, feria de proyectos y actividades de convivencia de la comunidad ASEIS en la Facultad Multidisciplinaria Oriental.
            </p>
        </div>
    </div>
</section>

<!-- Buscador Inteligente y Filtros -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-7 relative z-20">
    <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-4 sm:p-6">
        <form id="filter-form" action="{{ route('home') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-6 relative">
                <label for="search-input" class="block text-xs font-bold uppercase text-slate-500 mb-1">
                    Buscar experiencia
                </label>
                <div class="relative">
                    <input type="text" id="search-input" name="search" value="{{ request('search') }}"
                           autocomplete="off"
                           placeholder="Escribe un tema, ponente, autor o herramienta..."
                           class="w-full rounded-xl border-slate-300 border pl-4 pr-10 py-2.5 text-sm focus:ring-2 focus:ring-[#5EA83A] focus:border-[#5EA83A] focus:outline-none">
                    <button type="button" id="clear-search"
                            class="{{ request('search') ? '' : 'hidden' }} absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 font-bold text-lg leading-none"
                            title="Limpiar búsqueda">
                        ×
                    </button>
                </div>
            </div>

            <div class="md:col-span-4">
                <label for="category-select" class="block text-xs font-bold uppercase text-slate-500 mb-1">
                    Filtrar por actividad
                </label>
                <select id="category-select" name="category"
                        class="w-full rounded-xl border-slate-300 border px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-[#5EA83A] focus:border-[#5EA83A] focus:outline-none">
                    <option value="">Todas las actividades</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>
                            {{ $cat->name }} ({{ $cat->posts_count }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2 flex items-end gap-2">
                <button type="submit" class="w-full bg-[#5EA83A] hover:bg-[#4D8F2E] text-white font-bold py-2.5 px-4 rounded-xl text-sm transition shadow-sm">
                    Buscar
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Contenedor de Resultados Actualizable Dinámicamente -->
<section id="posts-results" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 transition-opacity duration-200">
    @if(request()->hasAny(['search', 'category']) && (request('search') || request('category')))
        <div class="flex flex-wrap items-center justify-between gap-2 mb-6 text-sm text-slate-600 bg-white px-4 py-2.5 rounded-xl border border-slate-200">
            <span>
                Mostrando <strong>{{ $posts->total() }}</strong> {{ $posts->total() === 1 ? 'resultado' : 'resultados' }}
                @if(request('search')) para <strong>"{{ request('search') }}"</strong> @endif
            </span>
            <a href="{{ route('home') }}" class="text-[#4D8F2E] font-bold hover:underline text-xs">
                Restablecer filtros
            </a>
        </div>
    @endif

    @if($posts->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center">
            <h2 class="text-lg font-bold text-[#0A0F0B]">No se encontraron entradas publicadas</h2>
            <p class="text-slate-500 text-sm mt-1">Intenta con otras palabras clave o selecciona otra actividad.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($posts as $post)
                <article class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col hover:shadow-lg hover:border-[#5EA83A]/50 transition">
                    <a href="{{ route('posts.show', $post->slug) }}" class="block h-48 bg-[#0A0F0B] overflow-hidden relative">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-tr from-[#0A0F0B] to-[#1D4020] flex items-center justify-center text-[#7ED356] font-extrabold text-sm px-4 text-center">
                                {{ $post->category->name }}
                            </div>
                        @endif
                        <span class="absolute top-3 left-3 bg-[#0A0F0B]/90 border border-[#5EA83A]/60 text-[#86E05B] text-xs font-bold px-3 py-1 rounded-lg">
                            {{ $post->category->name }}
                        </span>
                    </a>

                    <div class="p-5 flex-grow flex flex-col">
                        <div class="text-xs text-slate-500 flex items-center justify-between mb-2">
                            <span>Actividad: <strong class="text-[#0A0F0B]">{{ $post->activity_date->format('d/m/Y') }}</strong></span>
                            <span class="text-[#4D8F2E] font-semibold">{{ $post->images->count() }} evidencias</span>
                        </div>

                        <h2 class="text-lg font-extrabold text-[#0A0F0B] leading-snug mb-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-[#5EA83A] transition">
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
                            <a href="{{ route('posts.show', $post->slug) }}" class="font-bold text-[#4D8F2E] hover:underline">
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

<script>
    const form = document.getElementById('filter-form');
    const searchInput = document.getElementById('search-input');
    const categorySelect = document.getElementById('category-select');
    const clearBtn = document.getElementById('clear-search');
    const resultsContainer = document.getElementById('posts-results');
    let debounceTimer;

    async function fetchResults() {
        const params = new URLSearchParams(new FormData(form));
        const url = `${form.action}?${params.toString()}`;

        resultsContainer.classList.add('opacity-50');
        clearBtn.classList.toggle('hidden', !searchInput.value.trim());

        try {
            const response = await fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const html = await response.text();
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const newResults = doc.getElementById('posts-results');

            if (newResults) {
                resultsContainer.innerHTML = newResults.innerHTML;
                window.history.replaceState({}, '', url);
            }
        } finally {
            resultsContainer.classList.remove('opacity-50');
        }
    }

    searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(fetchResults, 400);
    });

    categorySelect.addEventListener('change', fetchResults);

    clearBtn.addEventListener('click', () => {
        searchInput.value = '';
        searchInput.focus();
        fetchResults();
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        clearTimeout(debounceTimer);
        fetchResults();
    });
</script>
@endsection