<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta | SDS 26 Green IoT - ASEIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-white text-[#0A0F0B] antialiased selection:bg-[#5EA83A] selection:text-white">
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-12">
        <!-- Panel Izquierdo -->
        <div class="hidden lg:flex lg:col-span-6 bg-gradient-to-br from-[#0A0F0B] via-[#112413] to-[#0A0F0B] text-white p-12 xl:p-16 flex-col justify-between relative overflow-hidden">
            <div class="absolute inset-0 opacity-15" style="background-image: radial-gradient(#5EA83A 1.25px, transparent 1.25px); background-size: 28px 28px;"></div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-[#5EA83A]/20 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <span class="inline-flex items-center gap-2 bg-[#5EA83A]/15 border border-[#5EA83A]/40 text-[#7ED356] text-xs font-bold uppercase tracking-widest px-3.5 py-1.5 rounded-full">
                    Comunidad ASEIS • UES FMO
                </span>
            </div>

            <div class="relative z-10 max-w-lg my-auto">
                <h1 class="text-4xl font-black tracking-tight leading-tight">
                    Únete al portal oficial de la <span class="text-[#7ED356]">Semana de Sistemas 2026</span>.
                </h1>
                <p class="mt-4 text-slate-300 text-base leading-relaxed">
                    Crea tu cuenta estudiantil para explorar todas las crónicas, talleres técnicos, ponencias del evento Green IoT.
                </p>
            </div>

            <div class="relative z-10 text-xs text-slate-400">
                Universidad de El Salvador • Facultad Multidisciplinaria Oriental
            </div>
        </div>

        <!-- Panel Derecho: Formulario -->
        <div class="lg:col-span-6 flex flex-col justify-center px-6 sm:px-12 xl:px-16 py-10 bg-white">
            <div class="w-full max-w-md mx-auto">
                <div class="mb-6 flex justify-center lg:justify-start">
                    <x-brand-logo size="md" />
                </div>

                <h2 class="text-2xl font-extrabold text-[#0A0F0B] mb-1">Registro de Estudiante</h2>
                <p class="text-sm text-slate-500 mb-6">Completa tus datos para obtener acceso inmediato.</p>

                @if($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 text-xs p-3.5 rounded-xl">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Nombre completo *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                               class="w-full border border-slate-300 bg-slate-50/60 focus:bg-white rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#5EA83A] focus:border-[#5EA83A] focus:outline-none">
                    </div>

                    <div>
                        <label for="carnet" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Carnet universitario (Opcional)</label>
                        <input type="text" id="carnet" name="carnet" value="{{ old('carnet') }}" placeholder="Ej. GG22014"
                               class="w-full border border-slate-300 bg-slate-50/60 focus:bg-white rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#5EA83A] focus:border-[#5EA83A] focus:outline-none">
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Correo electrónico *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="w-full border border-slate-300 bg-slate-50/60 focus:bg-white rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#5EA83A] focus:border-[#5EA83A] focus:outline-none">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Contraseña *</label>
                            <input type="password" id="password" name="password" required
                                   class="w-full border border-slate-300 bg-slate-50/60 focus:bg-white rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#5EA83A] focus:border-[#5EA83A] focus:outline-none">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Confirmar *</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                   class="w-full border border-slate-300 bg-slate-50/60 focus:bg-white rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#5EA83A] focus:border-[#5EA83A] focus:outline-none">
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full bg-[#5EA83A] hover:bg-[#4D8F2E] text-white font-bold py-3 rounded-xl transition shadow-lg shadow-[#5EA83A]/25 text-sm mt-2">
                        Crear Cuenta
                    </button>

                    <div class="text-center pt-4 border-t border-slate-100 text-sm text-slate-600">
                        ¿Ya tienes cuenta?
                        <a href="{{ route('login') }}" class="text-[#4D8F2E] font-bold hover:underline">Inicia sesión</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>