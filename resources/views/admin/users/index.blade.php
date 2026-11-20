@extends('layouts.admin')

@section('header', 'Usuarios y Permisos')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <p class="text-sm text-slate-600">Asigna o revoca permisos de administrador a los usuarios registrados en la plataforma.</p>

    <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-2 w-full sm:w-auto">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre, correo o carnet..."
               class="border border-slate-300 rounded-xl px-3.5 py-2 text-sm w-full sm:w-64 focus:ring-2 focus:ring-[#5EA83A] focus:outline-none">
        <button type="submit" class="bg-[#5EA83A] hover:bg-[#4D8F2E] text-white px-4 py-2 rounded-xl text-sm font-bold transition">
            Buscar
        </button>
    </form>
</div>

<!-- Contenedor con scroll horizontal suave para pantallas móviles -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-x-auto">
    <table class="w-full min-w-[680px] text-sm text-left">
        <thead class="bg-slate-50 border-b text-xs uppercase text-slate-500">
            <tr>
                <th class="px-5 py-3.5 whitespace-nowrap">Usuario</th>
                <th class="px-5 py-3.5 whitespace-nowrap">Carnet</th>
                <th class="px-5 py-3.5 whitespace-nowrap">Correo</th>
                <th class="px-5 py-3.5 whitespace-nowrap">Rol Actual</th>
                <th class="px-5 py-3.5 text-right whitespace-nowrap">Acción</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($users as $user)
                <tr class="hover:bg-slate-50/70">
                    <td class="px-5 py-3.5 font-bold text-[#0A0F0B] whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-5 py-3.5 text-slate-600 whitespace-nowrap">{{ $user->carnet ?? '—' }}</td>
                    <td class="px-5 py-3.5 text-slate-600 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-5 py-3.5 whitespace-nowrap">
                        @if($user->isAdmin())
                            <span class="bg-[#5EA83A]/15 text-[#2E5B18] border border-[#5EA83A]/30 text-xs font-bold px-2.5 py-0.5 rounded-full">
                                Administrador
                            </span>
                        @else
                            <span class="bg-slate-100 text-slate-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                Usuario Normal
                            </span>
                        @endif
                    </td>
                    <td class="px-5 py-3.5 text-right whitespace-nowrap">
                        @if(auth()->id() === $user->id)
                            <span class="text-xs text-slate-400 italic">Tu cuenta actual</span>
                        @else
                            <form action="{{ route('admin.users.toggle-role', $user) }}" method="POST" class="inline"
                                  onsubmit="return confirm('¿Confirmas el cambio de rol para {{ $user->name }}?')">
                                @csrf
                                @method('PATCH')
                                @if($user->isAdmin())
                                    <button type="submit" class="border border-slate-300 text-slate-700 hover:bg-slate-100 px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                        Quitar Admin
                                    </button>
                                @else
                                    <button type="submit" class="bg-[#5EA83A] hover:bg-[#4D8F2E] text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm">
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

<div class="mt-3 md:hidden flex justify-center">
    <p class="text-xs text-slate-500 bg-slate-100 px-3 py-1 rounded-full text-center">
        ← Desliza la tabla horizontalmente para ver todas las columnas →
    </p>
</div>

<div class="mt-4">{{ $users->links() }}</div>
@endsection