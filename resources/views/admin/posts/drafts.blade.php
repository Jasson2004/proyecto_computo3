@extends('layouts.admin')

@section('header', 'Borradores Privados')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-slate-600">Estas entradas son privadas y no aparecen en el blog público hasta ser publicadas.</p>
    <a href="{{ route('admin.posts.create') }}" class="bg-red-900 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-800">
        + Nuevo Borrador
    </a>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-slate-50 border-b text-xs uppercase text-slate-500">
            <tr>
                <th class="px-5 py-3">Título del Borrador</th>
                <th class="px-5 py-3">Categoría</th>
                <th class="px-5 py-3">Última Edición</th>
                <th class="px-5 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($drafts as $draft)
                <tr>
                    <td class="px-5 py-4">
                        <div class="font-bold text-slate-900">{{ $draft->title }}</div>
                        <div class="text-xs text-slate-500">{{ $draft->images->count() }} evidencias adjuntas</div>
                    </td>
                    <td class="px-5 py-4">{{ $draft->category->name }}</td>
                    <td class="px-5 py-4">{{ $draft->updated_at->diffForHumans() }}</td>
                    <td class="px-5 py-4 text-right space-x-2">
                        <a href="{{ route('admin.posts.edit', $draft) }}" class="text-indigo-700 font-semibold hover:underline">Continuar editando</a>
                        <form action="{{ route('admin.posts.publish', $draft) }}" method="POST" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="bg-emerald-600 text-white px-2.5 py-1 rounded text-xs font-semibold hover:bg-emerald-700">
                                Publicar ahora
                            </button>
                        </form>
                        <form action="{{ route('admin.posts.destroy', $draft) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar borrador definitivamente?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-700 font-semibold hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-8 text-center text-slate-500">No tienes borradores pendientes.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $drafts->links() }}</div>
@endsection