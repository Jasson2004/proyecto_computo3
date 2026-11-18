@extends('layouts.admin')

@section('header', 'Editar Categoría')

@section('content')
<div class="max-w-xl bg-white rounded-xl border border-slate-200 p-6 sm:p-8 shadow-sm">
    <h2 class="font-bold text-slate-900 text-lg mb-4">Modificar: {{ $category->name }}</h2>

    @if($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-700 p-3 rounded-lg text-sm mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Nombre de la categoría *</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                   class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Contenido mínimo esperado</label>
            <input type="text" name="min_content_guide" value="{{ old('min_content_guide', $category->min_content_guide) }}"
                   class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Descripción</label>
            <textarea name="description" rows="4"
                      class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-slate-300 rounded-lg text-sm font-medium text-slate-700">
                Cancelar
            </a>
            <button type="submit" class="bg-red-900 hover:bg-red-800 text-white font-semibold px-5 py-2 rounded-lg text-sm">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection