@extends('layouts.admin')

@section('header', 'Editar Entrada')

@section('content')
<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Título *</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Categoría *</label>
            <select name="category_id" required class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm">
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
            <input type="date" name="activity_date" value="{{ old('activity_date', $post->activity_date->format('Y-m-d')) }}" required class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Reemplazar imagen principal</label>
            <input type="file" name="featured_image" accept="image/*" class="w-full border border-slate-300 rounded-lg px-3 py-1.5 text-sm">
        </div>
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">Autores participantes *</label>
        <div class="flex flex-wrap gap-4 bg-slate-50 p-3.5 rounded-lg border border-slate-200">
            @php $selectedAuthors = old('authors', $post->authors->pluck('id')->toArray()); @endphp
            @foreach($admins as $admin)
                <label class="inline-flex items-center gap-2 text-sm">
                    <input type="checkbox" name="authors[]" value="{{ $admin->id }}" @checked(in_array($admin->id, $selectedAuthors)) class="rounded text-red-900">
                    <span>{{ $admin->name }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">Contenido *</label>
        <textarea name="content" rows="8" required class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm">{{ old('content', $post->content) }}</textarea>
    </div>

    <!-- Agregar nuevas evidencias -->
    <div class="border-t pt-4">
        <div class="flex justify-between items-center mb-3">
            <span class="font-bold text-sm">Añadir más evidencias</span>
            <button type="button" onclick="addEvidenceRow()" class="bg-slate-800 text-white px-3 py-1 rounded text-xs font-semibold">+ Añadir</button>
        </div>
        <div id="evidences_container" class="space-y-3"></div>
    </div>

    <div class="flex justify-end gap-3 pt-4 border-t">
        <button type="submit" name="action" value="draft" class="bg-amber-500 text-slate-950 font-bold px-5 py-2 rounded-lg text-sm">
            Guardar en Borradores
        </button>
        <button type="submit" name="action" value="published" class="bg-emerald-600 text-white font-bold px-5 py-2 rounded-lg text-sm">
            Guardar y Publicar
        </button>
    </div>
</form>

<!-- Evidencias ya cargadas -->
@if($post->images->isNotEmpty())
    <div class="bg-white rounded-xl border border-slate-200 p-6 mt-6 shadow-sm">
        <h3 class="font-bold text-slate-900 mb-4">Evidencias actuales</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach($post->images as $img)
                <div class="border rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-36 object-cover">
                    <div class="p-3 text-xs flex justify-between items-center">
                        <div>
                            <strong class="block">{{ $img->participant_name }}</strong>
                            <span class="text-slate-500">{{ $img->evidence_type }}</span>
                        </div>
                        <form action="{{ route('admin.images.destroy', $img) }}" method="POST" onsubmit="return confirm('¿Eliminar esta evidencia?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-700 font-bold hover:underline">Quitar</button>
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
        row.className = 'grid grid-cols-1 md:grid-cols-12 gap-3 bg-slate-50 p-3 rounded-lg border';
        row.innerHTML = `
            <div class="md:col-span-4"><input type="file" name="evidences[${evidenceIdx}][file]" accept="image/*" required class="w-full text-xs"></div>
            <div class="md:col-span-3"><input type="text" name="evidences[${evidenceIdx}][participant_name]" placeholder="Integrante" required class="w-full text-xs border p-1.5 rounded"></div>
            <div class="md:col-span-2">
                <select name="evidences[${evidenceIdx}][evidence_type]" class="w-full text-xs border p-1.5 rounded">
                    <option value="fotografia">Fotografía</option>
                    <option value="constancia">Constancia</option>
                    <option value="asistencia">Asistencia</option>
                </select>
            </div>
            <div class="md:col-span-3"><input type="text" name="evidences[${evidenceIdx}][caption]" placeholder="Descripción" class="w-full text-xs border p-1.5 rounded"></div>
        `;
        container.appendChild(row);
        evidenceIdx++;
    }
</script>
@endsection