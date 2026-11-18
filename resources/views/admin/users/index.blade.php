@extends('layouts.admin')

@section('header', 'Usuarios y Permisos')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <p class="text-sm text-slate-600">Asigna o revoca permisos de administrador a los usuarios registrados en la plataforma.</p>

    <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-2 w-full sm:w-auto">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre, correo o carnet..."
               class="border border-slate-300 rounded-lg px-3 py-1.5 text-sm w-full sm:w-64">
        <button type="submit" class="bg-slate-800 text-white px-3.5 py-1.5 rounded-lg text-sm font-semibold hover:bg-slate-700">
            Buscar
        </button>
    </form>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-slate-50 border-b text-xs uppercase text-slate-500">
            <tr>
                <th class="px-5 py-3">Usuario</th>
                <th class="px-5 py-3">Carnet</th>
                <th class="px-5 py-3">Correo</th>
                <th class="px-5 py-3">Rol Actual</th>
                <th class="px-5 py-3 text-right">Acción</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($users as $user)
                <tr>
                    <td class="px-5 py-3.5 font-bold text-slate-900">{{ $user->name }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $user->carnet ?? '—' }}</td>
                    <td class="px-5 py-3.5 text-slate-600">{{ $user->email }}</td>
                    <td class="px-5 py-3.5">
                        @if($user->isAdmin())
                            <span class="bg-red-100 text-red-900 text-xs font-bold px-2.5 py-0.5 rounded-full">Administrador</span>
                        @else
                            <span class="bg-slate-100 text-slate-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">Usuario Normal</span>
                        @endif
                    </td>
                    <td class="px-5 py-3.5 text-right">
                        @if(auth()->id() === $user->id)
                            <span class="text-xs text-slate-400 italic">Tu cuenta actual</span>
                        @else
                            <form action="{{ route('admin.users.toggle-role', $user) }}" method="POST" class="inline"
                                  onsubmit="return confirm('¿Confirmas el cambio de rol para {{ $user->name }}?')">
                                @csrf
                                @method('PATCH')
                                @if($user->isAdmin())
                                    <button type="submit" class="border border-slate-300 text-slate-700 hover:bg-slate-100 px-3 py-1 rounded-lg text-xs font-semibold">
                                        Quitar Admin
                                    </button>
                                @else
                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1 rounded-lg text-xs font-semibold">
                                        Hacer Admin
                                    </button>
                                @endif
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-8 text-center text-slate-500">No se encontraron usuarios.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $users->links() }}</div>
@endsection