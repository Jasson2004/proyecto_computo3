<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta | Blog Semana de Sistemas 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="bg-red-900 p-6 text-white text-center">
            <span class="inline-block bg-amber-400 text-red-950 font-black px-3 py-1 rounded-lg text-sm mb-2">UES - FMO</span>
            <h1 class="text-xl font-bold">Registro de Estudiantes</h1>
            <p class="text-xs text-red-200 mt-1">Semana de Sistemas 2026</p>
        </div>

        <form action="{{ route('register.store') }}" method="POST" class="p-6 sm:p-8 space-y-4">
            @csrf

            @if($errors->any())
                <div class="bg-red-50 border border-red-300 text-red-700 text-xs p-3 rounded-lg">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Nombre completo *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                       placeholder="Ej. Ana María Gómez"
                       class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm focus:ring-2 focus:ring-red-800 focus:outline-none">
            </div>

            <div>
                <label for="carnet" class="block text-sm font-semibold text-slate-700 mb-1">Carnet universitario (Opcional)</label>
                <input type="text" id="carnet" name="carnet" value="{{ old('carnet') }}"
                       placeholder="Ej. GG22014"
                       class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm focus:ring-2 focus:ring-red-800 focus:outline-none">
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       placeholder="correo@ues.edu.sv"
                       class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm focus:ring-2 focus:ring-red-800 focus:outline-none">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">Contraseña (mínimo 8 caracteres) *</label>
                <input type="password" id="password" name="password" required
                       class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm focus:ring-2 focus:ring-red-800 focus:outline-none">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1">Confirmar contraseña *</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="w-full border border-slate-300 rounded-lg px-3.5 py-2 text-sm focus:ring-2 focus:ring-red-800 focus:outline-none">
            </div>

            <button type="submit" class="w-full bg-red-900 hover:bg-red-800 text-white font-bold py-2.5 rounded-lg transition shadow">
                Registrarme
            </button>

            <div class="text-center pt-3 border-t border-slate-100 text-sm text-slate-600">
                ¿Ya tienes una cuenta?
                <a href="{{ route('login') }}" class="text-red-800 font-bold hover:underline">
                    Inicia sesión
                </a>
            </div>
        </form>
    </div>
</body>
</html>