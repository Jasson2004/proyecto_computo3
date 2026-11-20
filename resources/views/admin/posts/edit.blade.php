@extends('layouts.admin')

@section('header', 'Editar Entrada')

@section('content')
<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
    @csrf
    @method('PUT')

    @if($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-700 p-4 rounded-xl text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Título *</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                   class="w-full border border-slate-300 rounded-xl px-3.5 py-2 text-sm focus:ring-2 focus:ring-[#5EA83A] focus:outline-none">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Categoría *</label>
            <select name="category_id" required
                    class="w-full border border-slate-300 rounded-xl px-3.5 py-2 text-sm focus:ring-2 focus:ring-[#5EA83A] focus:outline-none">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de la actividad *</label>
            <input type="date" name="activity_date" value="{{ old('activity_date', $post->activity_date->format('Y-m-d')) }}" required
                   class="w-full border border-slate-300 rounded-xl px-3.5 py-2 text-sm focus:ring-2 focus:ring-[#5EA83A] focus:outline-none">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Reemplazar imagen principal</label>
            <input type="file" name="featured_image" accept="image/*"
                   class="w-full border border-slate-300 rounded-xl px-3 py-1.5 text-sm">
        </div>
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">Autores participantes *</label>
        <div class="flex flex-wrap gap-4 bg-slate-50 p-3.5 rounded-xl border border-slate-200">
            @php $selectedAuthors = old('authors', $post->authors->pluck('id')->toArray()); @endphp
            @foreach($admins as $admin)
                <label class="inline-flex items-center gap-2 text-sm">
                    <input type="checkbox" name="authors[]" value="{{ $admin->id }}" @checked(in_array($admin->id, $selectedAuthors)) class="rounded text-[#5EA83A]">
                    <span>{{ $admin->name }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">Contenido *</label>
        <textarea name="content" rows="8" required
                  class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-[#5EA83A] focus:outline-none">{{ old('content', $post->content) }}</textarea>
    </div>

    <!-- Agregar nuevas evidencias -->
    <div class="border-t border-slate-200 pt-5">
        <div class="flex flex-wrap justify-between items-center gap-3 mb-3">
            <div>
                <span class="font-bold text-sm text-[#0A0F0B] block">Añadir nuevas evidencias de asistencia</span>
                <span class="text-xs text-slate-500">Si agregas una sección por error, puedes quitarla con el botón "✕ Quitar sección".</span>
            </div>
            <button type="button" onclick="addEvidenceRow()"
                    class="bg-[#0A0F0B] hover:bg-[#1a261c] text-[#7ED356] border border-[#5EA83A]/40 px-3.5 py-2 rounded-xl text-xs font-bold transition">
                + Agregar Evidencia
            </button>
        </div>
        <div id="evidences_container" class="space-y-3"></div>
    </div>

    <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
        <button type="submit" name="action" value="draft" class="bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-5 py-2.5 rounded-xl text-sm">
            Guardar en Borradores
        </button>
        <button type="submit" name="action" value="published" class="bg-[#5EA83A] hover:bg-[#4D8F2E] text-white font-bold px-5 py-2.5 rounded-xl text-sm">
            Guardar y Publicar
        </button>
    </div>
</form>

<!-- Evidencias ya cargadas en la base de datos -->
@if($post->images->isNotEmpty())
    <div class="bg-white rounded-2xl border border-slate-200 p-6 mt-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="font-bold text-[#0A0F0B]">Evidencias Subidas Actualmente ({{ $post->images->count() }})</h3>
                <p class="text-xs text-slate-500">Puedes eliminar individualmente cualquier evidencia que hayas subido por error.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($post->images as $img)
                <div class="border border-slate-200 rounded-xl overflow-hidden bg-slate-50 flex flex-col">
                    <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $img->participant_name }}" class="w-full h-40 object-cover">
                    <div class="p-3.5 text-xs flex-grow flex flex-col justify-between gap-3">
                        <div>
                            <div class="flex items-center justify-between gap-2">
                                <strong class="text-sm text-[#0A0F0B]">{{ $img->participant_name }}</strong>
                                <span class="uppercase bg-[#5EA83A]/15 text-[#2E5B18] font-bold px-2 py-0.5 rounded">
                                    {{ $img->evidence_type }}
                                </span>
                            </div>
                            @if($img->caption)
                                <p class="text-slate-600 mt-1">{{ $img->caption }}</p>
                            @endif
                        </div>

                        <form action="{{ route('admin.images.destroy', $img) }}" method="POST"
                              onsubmit="return confirm('¿Seguro que deseas borrar esta evidencia subida de {{ $img->participant_name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full bg-red-50 hover:bg-red-600 text-red-700 hover:text-white border border-red-200 font-bold py-2 px-3 rounded-lg transition text-center">
                                Borrar evidencia subida
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

<script>
    let evidenceIdx = 0;

    function addEvidenceRow() {
        const container = document.getElementById('evidences_container');
        const row = document.createElement('div');
        row.className = 'evidence-row bg-slate-50 p-4 rounded-xl border border-slate-200 relative transition';
        row.innerHTML = `
            <div class="flex items-center justify-between mb-3 pb-2 border-b border-slate-200/80">
                <span class="text-xs font-bold uppercase tracking-wider text-[#2E5B18]">
                    Nueva Evidencia #${evidenceIdx + 1}
                </span>
                <button type="button" onclick="removeEvidenceRow(this)"
                        class="inline-flex items-center gap-1 text-xs font-bold text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 border border-red-200 px-2.5 py-1 rounded-lg transition">
                    ✕ Quitar sección
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                <div class="md:col-span-4">
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Archivo de imagen *</label>
                    <div class="flex items-center gap-1.5">
                        <input type="file" name="evidences[${evidenceIdx}][file]" accept="image/*" required
                               onchange="toggleClearFileBtn(this)"
                               class="w-full text-xs border border-slate-300 bg-white p-1.5 rounded-lg">
                        <button type="button" onclick="clearFileInput(this)" title="Quitar archivo seleccionado"
                                class="hidden clear-file-btn text-xs font-bold text-slate-500 hover:text-red-600 px-2 py-1.5 border border-slate-300 bg-white rounded-lg">
                            Limpiar
                        </button>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Integrante que acredita *</label>
                    <input type="text" name="evidences[${evidenceIdx}][participant_name]" placeholder="Nombre completo" required
                           class="w-full text-xs border border-slate-300 bg-white p-2 rounded-lg">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tipo *</label>
                    <select name="evidences[${evidenceIdx}][evidence_type]" class="w-full text-xs border border-slate-300 bg-white p-2 rounded-lg">
                        <option value="fotografia">Fotografía</option>
                        <option value="constancia">Constancia</option>
                        <option value="asistencia">Asistencia</option>
                    </select>
                </div>

                <div class="md:col-span-3">
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Descripción breve</label>
                    <input type="text" name="evidences[${evidenceIdx}][caption]" placeholder="Ej. Participando en el taller"
                           class="w-full text-xs border border-slate-300 bg-white p-2 rounded-lg">
                </div>
            </div>
        `;
        container.appendChild(row);
        evidenceIdx++;
    }

    function removeEvidenceRow(button) {
        const row = button.closest('.evidence-row');
        if (row) {
            row.remove();
        }
    }

    function toggleClearFileBtn(input) {
        const btn = input.parentElement.querySelector('.clear-file-btn');
        if (btn) {
            btn.classList.toggle('hidden', !input.files.length);
        }
    }

    function clearFileInput(button) {
        const input = button.parentElement.querySelector('input[type="file"]');
        if (input) {
            input.value = '';
            button.classList.add('hidden');
        }
    }
</script>
@endsection