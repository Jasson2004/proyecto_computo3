<div id="logout-modal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-[#0A0F0B]/70 backdrop-blur-sm p-4 transition-opacity"
     role="dialog" aria-modal="true" aria-labelledby="logout-modal-title">

    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl max-w-md w-full overflow-hidden transform transition-all">
        <!-- Encabezado con acento Green IoT -->
        <div class="bg-[#0A0F0B] px-6 py-4 border-b-2 border-[#5EA83A] flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full bg-[#5EA83A]"></span>
                <h3 id="logout-modal-title" class="text-white font-extrabold text-base tracking-tight">
                    Confirmar cierre de sesión
                </h3>
            </div>
            <button type="button" onclick="closeLogoutModal()" class="text-slate-400 hover:text-white text-lg font-bold leading-none">
                ✕
            </button>
        </div>

        <!-- Cuerpo del mensaje -->
        <div class="p-6">
            <p class="text-sm text-slate-600 leading-relaxed">
                ¿Estás seguro de que deseas salir de tu cuenta <strong class="text-[#0A0F0B]">{{ auth()->user()->name }}</strong>? Tendrás que volver a iniciar sesión para acceder al contenido.
            </p>

            <!-- Botones de acción -->
            <div class="mt-6 flex flex-col-reverse sm:flex-row justify-end gap-2.5">
                <button type="button" onclick="closeLogoutModal()"
                        class="w-full sm:w-auto px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 text-sm font-bold transition">
                    Cancelar
                </button>

                <form action="{{ route('logout') }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit"
                            class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm font-bold transition shadow-sm">
                        Sí, cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openLogoutModal() {
        const modal = document.getElementById('logout-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeLogoutModal() {
        const modal = document.getElementById('logout-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Cerrar al hacer clic fuera de la tarjeta del modal
    document.getElementById('logout-modal')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeLogoutModal();
        }
    });

    // Cerrar al presionar la tecla Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeLogoutModal();
        }
    });
</script>