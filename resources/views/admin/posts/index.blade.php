@extends('layouts.admin')

@section('header', 'Publicaciones Activas')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-slate-600">Entradas visibles actualmente en la página pública del blog.</p>
    <a href="{{ route('admin.posts.create') }}" class="bg-red-900 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-800">
        + Nueva Entrada
    </a>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="bg-slate-50 border-b text-xs uppercase text-slate-500">
            <tr>
                <th class="px-5 py-3">Entrada</th>
                <th class="px-5 py-3">Categoría</th>
                <th class="px-5 py-3">Fecha Actividad</th>
                <th class="px-5 py-3">Evidencias</th>
                <th class="px-5 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($posts as $post)
                <tr>
                    <td class="px-5 py-4">
                        <div class="font-bold text-slate-900">{{ $post->title }}</div>
                        <div class="text-xs text-slate-500">Autores: {{ $post->authors->pluck('name')->join(', ') }}</div>
                    </td>
                    <td class="px-5 py-4">{{ $post->category->name }}</td>
                    <td class="px-5 py-4">{{ $post->activity_date->format('d/m/Y') }}</td>
                    <td class="px-5 py-4">{{ $post->images->count() }} archivos</td>
                    <td class="px-5 py-4 text-right space-x-2">
                        <a href="{{ route('posts.show', $post->slug) }}" target="_blank" class="text-slate-600 hover:underline">Ver</a>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-indigo-700 font-semibold hover:underline">Editar</a>
                        <form action="{{ route('admin.posts.unpublish', $post) }}" method="POST" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="text-amber-700 font-semibold hover:underline">Despublicar</button>
                        </form>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta publicación y sus evidencias?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-700 font-semibold hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-8 text-center text-slate-500">No hay entradas publicadas todavía.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3 md:hidden flex justify-center">
    <p class="text-xs text-slate-500 bg-slate-100 px-3 py-1 rounded-full text-center">
        ← Desliza la tabla horizontalmente para ver todas las columnas →
    </p>
</div>
<div class="mt-4">{{ $posts->links() }}</div>
@endsection