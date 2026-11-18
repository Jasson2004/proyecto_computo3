@extends('layouts.admin')

@section('header', 'Panel de Control — Semana de Sistemas 2026')

@section('content')
<!-- Métricas -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
        <span class="text-xs font-bold uppercase text-slate-400">Total Entradas</span>
        <div class="text-3xl font-extrabold text-slate-900 mt-1">{{ $stats['total_posts'] }}</div>
    </div>
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
        <span class="text-xs font-bold uppercase text-emerald-600">Publicadas</span>
        <div class="text-3xl font-extrabold text-emerald-700 mt-1">{{ $stats['published_posts'] }}</div>
    </div>
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
        <span class="text-xs font-bold uppercase text-amber-600">Borradores</span>
        <div class="text-3xl font-extrabold text-amber-600 mt-1">{{ $stats['draft_posts'] }}</div>
    </div>
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
        <span class="text-xs font-bold uppercase text-slate-400">Categorías</span>
        <div class="text-3xl font-extrabold text-slate-900 mt-1">{{ $stats['categories_count'] }}</div>
    </div>
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
        <span class="text-xs font-bold uppercase text-indigo-600">Evidencias</span>
        <div class="text-3xl font-extrabold text-indigo-700 mt-1">{{ $stats['evidences_count'] }}</div>
    </div>
</div>

<!-- Accesos Rápidos -->
<div class="flex flex-wrap gap-3 mb-8">
    <a href="{{ route('admin.posts.create') }}" class="bg-red-900 hover:bg-red-800 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-sm">
        + Crear Nueva Publicación
    </a>
    <a href="{{ route('admin.posts.drafts') }}" class="bg-white hover:bg-slate-50 border border-slate-300 text-slate-800 px-4 py-2 rounded-lg text-sm font-semibold">
        Revisar Borradores ({{ $stats['draft_posts'] }})
    </a>
    <a href="{{ route('admin.categories.index') }}" class="bg-white hover:bg-slate-50 border border-slate-300 text-slate-800 px-4 py-2 rounded-lg text-sm font-semibold">
        Gestionar Categorías
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Cobertura de Actividades Obligatorias -->
    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <h2 class="font-bold text-slate-900 mb-3">Actividades Obligatorias (Rúbrica)</h2>
        <ul class="divide-y divide-slate-100 text-sm">
            @foreach($categoriesCoverage as $cat)
                <li class="py-2.5 flex items-center justify-between">
                    <span class="font-medium text-slate-700">{{ $cat->name }}</span>
                    <div class="flex gap-1.5 text-xs">
                        <span class="bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded font-semibold">{{ $cat->published_count }} pub</span>
                        <span class="bg-amber-100 text-amber-800 px-2 py-0.5 rounded font-semibold">{{ $cat->draft_count }} borr</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Últimas Entradas Modificadas -->
    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <h2 class="font-bold text-slate-900 mb-3">Actividad Reciente</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs uppercase text-slate-400 border-b">
                    <tr>
                        <th class="py-2">Título</th>
                        <th class="py-2">Categoría</th>
                        <th class="py-2">Estado</th>
                        <th class="py-2 text-right">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($recentPosts as $post)
                        <tr>
                            <td class="py-3 font-medium text-slate-900">{{ $post->title }}</td>
                            <td class="py-3 text-slate-600">{{ $post->category->name }}</td>
                            <td class="py-3">
                                @if($post->status === 'published')
                                    <span class="bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Publicado</span>
                                @else
                                    <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Borrador</span>
                                @endif
                            </td>
                            <td class="py-3 text-right">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="text-red-800 hover:underline font-semibold">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection