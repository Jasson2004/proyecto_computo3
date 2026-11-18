<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Blog Semana de Sistemas 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="bg-red-900 p-6 text-white text-center">
            <span class="inline-block bg-amber-400 text-red-950 font-black px-3 py-1 rounded-lg text-sm mb-2">UES - FMO</span>
            <h1 class="text-xl font-bold">Semana de Sistemas 2026</h1>
            <p class="text-xs text-red-200 mt-1">Acceso al Sistema de Gestión del Blog</p>
        </div>

        <form action="{{ route('login.attempt') }}" method="POST" class="p-6 sm:p-8 space-y-5">
            @csrf

            @if($errors->any())
                <div class="bg-red-50 border border-red-300 text-red-700 text-sm p-3 rounded-lg">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-red-800 focus:outline-none">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">Contraseña</label>
                <input type="password" id="password" name="password" required
                       class="w-full border border-slate-300 rounded-lg px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-red-800 focus:outline-none">
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="inline-flex items-center gap-2 text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-red-900">
                    <span>Mantener sesión</span>
                </label>
                <a href="{{ route('home') }}" class="text-red-800 hover:underline font-medium">Ir al blog público</a>
            </div>

            <button type="submit" class="w-full bg-red-900 hover:bg-red-800 text-white font-bold py-2.5 rounded-lg transition shadow">
                Ingresar al Sistema
            </button>

            <div class="text-center pt-3 border-t border-slate-100 text-sm text-slate-600">
                ¿Aún no tienes cuenta?
                <a href="{{ route('register') }}" class="text-red-800 font-bold hover:underline">
                    Regístrate aquí
                </a>
            </div>
        </form>
    </div>
</body>
</html>