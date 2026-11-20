<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | SDS 26 Green IoT - ASEIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-white text-[#0A0F0B] antialiased selection:bg-[#5EA83A] selection:text-white">
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-12">
        
        <!-- Panel Izquierdo: Identidad Visual Green IoT -->
        <div class="hidden lg:flex lg:col-span-7 bg-gradient-to-br from-[#0A0F0B] via-[#112413] to-[#0A0F0B] text-white p-12 xl:p-16 flex-col justify-between relative overflow-hidden">
            <!-- Patrón de cuadrícula tecnológica sutil -->
            <div class="absolute inset-0 opacity-15" style="background-image: radial-gradient(#5EA83A 1.25px, transparent 1.25px); background-size: 28px 28px;"></div>
            <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-[#5EA83A]/20 rounded-full blur-3xl"></div>
            <div class="absolute top-20 right-10 w-72 h-72 bg-[#5EA83A]/10 rounded-full blur-3xl"></div>

            <!-- Encabezado Institucional -->
            <div class="relative z-10 flex items-center gap-3">
                <span class="inline-flex items-center gap-2 bg-[#5EA83A]/15 border border-[#5EA83A]/40 text-[#7ED356] text-xs font-bold uppercase tracking-widest px-3.5 py-1.5 rounded-full">
                    <span class="w-2 h-2 rounded-full bg-[#5EA83A] animate-pulse"></span>
                    UES • Facultad Multidisciplinaria Oriental
                </span>
            </div>

            <!-- Mensaje Central -->
            <div class="relative z-10 max-w-xl my-auto">
                <p class="text-[#7ED356] font-bold tracking-wider uppercase text-sm mb-3">
                    Semana de Sistemas 2026 • Edición Green IoT
                </p>
                <h1 class="text-4xl xl:text-5xl font-black tracking-tight leading-tight text-white">
                    Tecnología sostenible conectando el futuro.
                </h1>
                <p class="mt-5 text-slate-300 text-base xl:text-lg leading-relaxed">
                    Accede a la plataforma oficial para documentar ponencias, talleres prácticos, feria de proyectos y evidencias de participación estudiantil.
                </p>

                <!-- Tarjetas de estado IoT -->
                <div class="grid grid-cols-3 gap-4 mt-10 pt-8 border-t border-white/10">
                    <div>
                        <span class="text-2xl font-black text-[#7ED356] block">SDS 26</span>
                        <span class="text-xs text-slate-400">Edición Oficial</span>
                    </div>
                    <div>
                        <span class="text-2xl font-black text-white block">Green IoT</span>
                        <span class="text-xs text-slate-400">Eje Temático</span>
                    </div>
                    <div>
                        <span class="text-2xl font-black text-[#7ED356] block">ASEIS</span>
                        <span class="text-xs text-slate-400">Comunidad FMO</span>
                    </div>
                </div>
            </div>

            <!-- Pie del panel -->
            <div class="relative z-10 text-xs text-slate-400 flex items-center justify-between">
                <span>Universidad de El Salvador</span>
                <span>Técnicas de Programación para Internet</span>
            </div>
        </div>

        <!-- Panel Derecho: Formulario de Acceso -->
        <div class="lg:col-span-5 flex flex-col justify-center px-6 sm:px-12 xl:px-16 py-12 bg-white">
            <div class="w-full max-w-md mx-auto">
                <!-- Logotipo Oficial -->
                <div class="mb-8 flex justify-center lg:justify-start">
                    <x-brand-logo size="lg" />
                </div>

                <div class="mb-7 text-center lg:text-left">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0A0F0B] tracking-tight">
                        Bienvenido de nuevo
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Ingresa tus credenciales para acceder al blog y sus actividades.
                    </p>
                </div>

                @if(session('success'))
                    <div class="mb-5 bg-[#5EA83A]/10 border border-[#5EA83A]/40 text-[#2E5B18] text-sm p-3.5 rounded-xl font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-5 bg-red-50 border border-red-200 text-red-700 text-sm p-3.5 rounded-xl">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.attempt') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                            Correo electrónico
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="estudiante@ues.edu.sv"
                               class="w-full border border-slate-300 bg-slate-50/60 focus:bg-white rounded-xl px-4 py-3 text-sm text-[#0A0F0B] focus:ring-2 focus:ring-[#5EA83A] focus:border-[#5EA83A] focus:outline-none transition">
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                            Contraseña
                        </label>
                        <input type="password" id="password" name="password" required
                               placeholder="••••••••••••"
                               class="w-full border border-slate-300 bg-slate-50/60 focus:bg-white rounded-xl px-4 py-3 text-sm text-[#0A0F0B] focus:ring-2 focus:ring-[#5EA83A] focus:border-[#5EA83A] focus:outline-none transition">
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="inline-flex items-center gap-2 text-slate-600 cursor-pointer">
                            <input type="checkbox" name="remember" class="rounded border-slate-300 text-[#5EA83A] focus:ring-[#5EA83A]">
                            <span>Mantener sesión iniciada</span>
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full bg-[#5EA83A] hover:bg-[#4D8F2E] text-white font-bold py-3.5 px-4 rounded-xl transition shadow-lg shadow-[#5EA83A]/25 text-sm tracking-wide">
                        Iniciar Sesión
                    </button>

                    <div class="text-center pt-5 border-t border-slate-100 text-sm text-slate-600">
                        ¿Aún no tienes una cuenta?
                        <a href="{{ route('register') }}" class="text-[#4D8F2E] font-bold hover:underline">
                            Regístrate aquí
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>