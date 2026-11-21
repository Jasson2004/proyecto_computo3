@extends('layouts.public')

@section('title', $post->title . ' | Semana de Sistemas 2026')

@section('content')
<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-red-800 hover:underline mb-6">
        ← Volver a todas las actividades
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        @if($post->featured_image)
            <div class="max-h-[440px] overflow-hidden bg-slate-900">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-6 sm:p-10">
            <div class="flex flex-wrap items-center gap-3 text-xs mb-4">
                <span class="bg-red-100 text-red-900 font-bold px-3 py-1 rounded-full">
                    {{ $post->category->name }}
                </span>
                <span class="text-slate-500">
                    Fecha de actividad: <strong>{{ $post->activity_date->format('d/m/Y') }}</strong>
                </span>
                <span class="text-slate-400">•</span>
                <span class="text-slate-500">
                    Publicado: {{ $post->published_at->format('d/m/Y H:i') }}
                </span>
            </div>

            <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 leading-tight mb-4">
                {{ $post->title }}
            </h1>

            <!-- Autores de la pareja -->
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-8 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <span class="text-xs uppercase font-bold text-slate-400 block">Autores participantes</span>
                    <div class="flex flex-wrap gap-2 mt-1">
                        @foreach($post->authors as $author)
                            <span class="inline-flex items-center gap-1.5 bg-white border border-slate-300 px-3 py-1 rounded-lg text-sm font-medium text-slate-800">
                                {{ $author->name }} @if($author->carnet)<span class="text-xs text-slate-500">({{ $author->carnet }})</span>@endif
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Contenido Principal -->
            <div class="prose max-w-none text-slate-700 leading-relaxed whitespace-pre-line text-base">
                {{ $post->content }}
            </div>

            <!-- Galería de Evidencias Individuales -->
            @if($post->images->isNotEmpty())
                <div class="mt-12 pt-8 border-t border-slate-200">
                    <h2 class="text-xl font-bold text-slate-900 mb-1">Evidencias Verificables de Participación</h2>
                    <p class="text-sm text-slate-500 mb-6">Respaldo fotográfico y registros individuales de los integrantes del equipo.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($post->images as $evidence)
                            <figure class="border border-slate-200 rounded-xl overflow-hidden bg-slate-50">
                                <img src="{{ asset('storage/' . $evidence->image_path) }}" alt="{{ $evidence->caption ?? 'Evidencia' }}" class="w-full h-56 object-cover cursor-zoom-in" onclick="abrirZoom(this.src, this.alt)">
                                <figcaption class="p-4 text-sm">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-bold text-slate-900">{{ $evidence->participant_name }}</span>
                                        <span class="text-xs uppercase bg-emerald-100 text-emerald-800 font-semibold px-2 py-0.5 rounded">
                                            {{ $evidence->evidence_type }}
                                        </span>
                                    </div>
                                    @if($evidence->caption)
                                        <p class="text-slate-600 text-xs mt-1">{{ $evidence->caption }}</p>
                                    @endif
                                </figcaption>
                            </figure>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</article>

<div id="zoom-modal" class="fixed inset-0 z-50 hidden bg-black/90" onclick="cerrarZoom()">
    <button type="button" class="absolute top-4 right-5 z-10 text-white text-4xl leading-none" onclick="cerrarZoom()" aria-label="Cerrar">&times;</button>
    <div class="w-full h-full overflow-auto flex p-4">
        <img id="zoom-img" src="" alt="" class="m-auto cursor-zoom-in" style="max-width:100%;max-height:100%;" onclick="event.stopPropagation(); alternarZoom()">
    </div>
    <p class="absolute bottom-3 left-0 right-0 text-center text-xs text-white/70 pointer-events-none">Toca la imagen para acercar o alejar. Toca fuera o presiona Esc para cerrar.</p>
</div>
<script>
    var zoomActivo = false;
    function abrirZoom(src, alt) {
        var img = document.getElementById('zoom-img');
        img.src = src;
        img.alt = alt || 'Evidencia';
        zoomActivo = false;
        aplicarZoom();
        document.getElementById('zoom-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function cerrarZoom() {
        document.getElementById('zoom-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    function alternarZoom() {
        zoomActivo = !zoomActivo;
        aplicarZoom();
    }
    function aplicarZoom() {
        var img = document.getElementById('zoom-img');
        if (zoomActivo) {
            img.style.maxWidth = 'none';
            img.style.maxHeight = 'none';
            img.style.width = '200%';
            img.style.cursor = 'zoom-out';
        } else {
            img.style.maxWidth = '100%';
            img.style.maxHeight = '100%';
            img.style.width = 'auto';
            img.style.cursor = 'zoom-in';
        }
    }
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { cerrarZoom(); }
    });
</script>
@endsection