@extends('layouts.admin')

@section('header', 'Categorías de Actividades')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Formulario Nueva Categoría -->
    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm h-fit">
        <h2 class="font-bold text-slate-900 mb-4">Nueva Categoría</h2>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Nombre *</label>
                <input type="text" name="name" required class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Contenido mínimo esperado</label>
                <input type="text" name="min_content_guide" placeholder="Ej. Tema, expositor, aprendizajes" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Descripción</label>
                <textarea name="description" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"></textarea>
            </div>
            <button type="submit" class="w-full bg-red-900 text-white font-semibold py-2 rounded-lg text-sm hover:bg-red-800">
                Guardar Categoría
            </button>
        </form>
    </div>

    <!-- Tabla de Categorías -->
    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 border-b text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-5 py-3">Categoría</th>
                    <th class="px-5 py-3">Requisitos mínimos</th>
                    <th class="px-5 py-3 text-center">Entradas</th>
                    <th class="px-5 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($categories as $category)
                    <tr>
                        <td class="px-5 py-3.5 font-bold text-slate-900">{{ $category->name }}</td>
                        <td class="px-5 py-3.5 text-xs text-slate-600">{{ $category->min_content_guide }}</td>
                        <td class="px-5 py-3.5 text-center">{{ $category->posts_count }}</td>
                        <td class="px-5 py-3.5 text-right space-x-3">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-700 font-semibold hover:underline text-xs">
                                Editar
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar categoría?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-700 font-semibold hover:underline text-xs">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3 md:hidden flex justify-center">
      <p class="text-xs text-slate-500 bg-slate-100 px-3 py-1 rounded-full text-center">
        ← Desliza la tabla horizontalmente para ver todas las columnas →
      </p>
    </div>
</div>
@endsection