@extends('layouts.admin')

@section('header', 'Crear Nueva Entrada — Semana de Sistemas 2026')

@section('content')
<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
    @csrf

    @if($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-700 p-4 rounded-lg text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Título de la entrada *</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   placeholder="Ej. Ponencia: Arquitectura Cloud en la Industria Actual"
                   class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Categoría / Actividad *</label>
            <select name="category_id" id="category_select" required class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" data-guide="{{ $category->min_content_guide }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <p id="category_guide" class="text-xs text-amber-800 bg-amber-50 border border-amber-200 rounded px-2.5 py-1 mt-1.5"></p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha real de la actividad *</label>
            <input type="date" name="activity_date" value="{{ old('activity_date', date('Y-m-d')) }}" required
                   class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Imagen principal (Portada)</label>
            <input type="file" name="featured_image" accept="image/*"
                   class="w-full border border-slate-300 rounded-lg px-3 py-1.5 text-sm">
        </div>
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">Integrantes autores participantes *</label>
        <div class="flex flex-wrap gap-4 bg-slate-50 p-3.5 rounded-lg border border-slate-200">
            @foreach($admins as $admin)
                <label class="inline-flex items-center gap-2 text-sm">
                    <input type="checkbox" name="authors[]" value="{{ $admin->id }}" checked class="rounded text-red-900">
                    <span>{{ $admin->name }} ({{ $admin->carnet ?? 'Admin' }})</span>
                </label>
            @endforeach
        </div>
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1">Crónica, desarrollo y reflexión personal *</label>
        <textarea name="content" rows="8" required
                  placeholder="Describe los hechos reales ocurridos, aprendizajes técnicos y tu reflexión personal..."
                  class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm">{{ old('content') }}</textarea>
    </div>

    <!-- Evidencias Individuales -->
    <div class="border-t pt-6">
        <div class="flex items-center justify-between mb-3">
            <div>
                <h3 class="font-bold text-slate-900">Evidencias Verificables de Asistencia (Por Integrante)</h3>
                <p class="text-xs text-slate-500">Adjunta fotografías propias, constancias o capturas de registro por cada integrante.</p>
            </div>
            <button type="button" onclick="addEvidenceRow()" class="bg-slate-800 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-slate-700">
                + Agregar Evidencia
            </button>
        </div>

        <div id="evidences_container" class="space-y-3"></div>
    </div>

    <div class="flex flex-wrap justify-end gap-3 pt-4 border-t">
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 border border-slate-300 rounded-lg text-sm font-medium text-slate-700">Cancelar</a>
        <button type="submit" name="action" value="draft" class="bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-5 py-2 rounded-lg text-sm">
            Guardar como Borrador
        </button>
        <button type="submit" name="action" value="published" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2 rounded-lg text-sm">
            Publicar Ahora
        </button>
    </div>
</form>

<script>
    const select = document.getElementById('category_select');
    const guideBox = document.getElementById('category_guide');
    function updateGuide() {
        const opt = select.options[select.selectedIndex];
        guideBox.textContent = 'Contenido mínimo requerido: ' + (opt.dataset.guide || 'Descripción y reflexión.');
    }
    select.addEventListener('change', updateGuide);
    updateGuide();

    let evidenceIdx = 0;
    function addEvidenceRow() {
        const container = document.getElementById('evidences_container');
        const row = document.createElement('div');
        row.className = 'grid grid-cols-1 md:grid-cols-12 gap-3 bg-slate-50 p-3.5 rounded-lg border border-slate-200 items-end';
        row.innerHTML = `
            <div class="md:col-span-4">
                <label class="block text-xs font-semibold mb-1">Archivo de imagen *</label>
                <input type="file" name="evidences[${evidenceIdx}][file]" accept="image/*" required class="w-full text-xs border bg-white p-1.5 rounded">
            </div>
            <div class="md:col-span-3">
                <label class="block text-xs font-semibold mb-1">Integrante que acredita *</label>
                <input type="text" name="evidences[${evidenceIdx}][participant_name]" placeholder="Nombre completo" required class="w-full text-xs border p-2 rounded">
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold mb-1">Tipo *</label>
                <select name="evidences[${evidenceIdx}][evidence_type]" class="w-full text-xs border p-2 rounded bg-white">
                    <option value="fotografia">Fotografía</option>
                    <option value="constancia">Constancia</option>
                    <option value="asistencia">Asistencia</option>
                </select>
            </div>
            <div class="md:col-span-3">
                <label class="block text-xs font-semibold mb-1">Descripción breve</label>
                <input type="text" name="evidences[${evidenceIdx}][caption]" placeholder="Ej. Participando en el taller" class="w-full text-xs border p-2 rounded">
            </div>
        `;
        container.appendChild(row);
        evidenceIdx++;
    }
    addEvidenceRow();
</script>
@endsection