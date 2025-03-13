<!-- Botón para abrir/cerrar la barra lateral -->
<div>
    <button
        class="cursor-pointer fixed top-4 left-4 bg-white border border-gray-100 rounded-b-md text-gray-800 focus:text-white p-2 rounded z-auto"
        onclick="toggleSidebar()">
        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
        </svg>
    </button>

    <a href="/"
        class="cursor-pointer fixed top-18 left-4 bg-white border border-gray-100 rounded-b-md text-gray-800 focus:text-white p-2 rounded z-auto">
        <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                clip-rule="evenodd" />
        </svg>
    </a>
</div>

<!-- Barra lateral (aside) -->
<aside
    class="fixed top-0 left-0 w-3/4 md:w-1/4 h-full bg-white border border-gray-200 rounded-lg p-4 transform -translate-x-full transition-transform duration-300 ease-in-out z-20 overflow-y-auto"
    id="sidebar">

    <p class="text-center pt-10 md:pt-1 md:pb-4 text-xl font-semibold border-b border-gray-200 w-full">
        <a wire:navigate href="{{ route('index') }}">Clinica Veterinaria</a>
    </p>

    <!-- Botón de cerrar (visible en móviles) -->
    <button class="absolute top-4 right-4 text-gray-600 hover:text-gray-900" onclick="toggleSidebar()">
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <p class="text-center pt-10 md:pt-2 md:pb-3 text-xl font-semibold border-b border-gray-200 w-full">
        <a wire:navigate href="{{ route('index') }}">Inicio</a>
    </p>

    <!-- Menú -->
    <div class="mt-4 space-y-0.5">
        <!-- Ejemplo de un elemento del menú -->
        <div>
            <a wire:navigate href="">
                <div class="relative group overflow-hidden transition-all duration-300 h-10 hover:h-24  md:w-full rounded-lg"
                    style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/gestion-pacientes.jpg') }}'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-4">
                        <h3 class=" text-md font-bold">Gestión de Pacientes</h3>

                    </div>
                </div>
            </a>
        </div>

        <div>
            <a wire:navigate href="{{ route('consultas') }}">
                <div class="relative group overflow-hidden transition-all duration-300 h-10 hover:h-24 w-full rounded-lg"
                    style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/historial.jpeg') }}'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-4">
                        <h3 class=" text-md font-bold">Historial Clínica</h3>
                        <p class="hidden group-hover:block mt-2 text-xs text-center">
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <div>
            <a href="">
                <div class="relative group overflow-hidden transition-all duration-300 h-10 hover:h-24 w-full rounded-lg"
                    style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/agenda.webp') }}'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-4">
                        <h3 class=" text-md font-bold">Agenda de Citas</h3>
                        <p class="hidden group-hover:block mt-2 text-xs text-center">
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <div>
            <a href="">
                <div class=" relative group overflow-hidden transition-all duration-300 h-10 hover:h-24 w-full rounded-lg "
                    style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/pago.jpg') }}'); background-size: cover; background-position: center; ">
                    <div
                        class="{{ session('caja') ? 'backdrop-blur-xs' : '' }} absolute inset-0 flex flex-col justify-center items-center text-white p-4">
                        <h3 class=" text-md font-bold">
                            Caja
                            @if (session('caja'))
                                <span
                                    class=" px-3 py-1.5 rounded-full bg-gradient-to-r from-red-500 gap-1 to-red-600 shadow-lg">
                                    {{ count(session('caja')) }}
                                </span>
                            @endif
                        </h3>
                        <p class="hidden group-hover:block mt-2 text-xs text-center">
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <div>
            <a wire:navigate href="{{ route('inventario') }}">
                <div class="relative group overflow-hidden transition-all duration-300 h-10 hover:h-24 w-full rounded-lg"
                    style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/inventario.jpg') }}'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-4">
                        <h3 class=" text-md font-bold">Inventario</h3>
                        <p class="hidden group-hover:block mt-2 text-xs text-center">
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <div>
            <a wire:navigate href="{{ route('gestion.roles') }}">
                <div class="relative group overflow-hidden transition-all duration-300 h-10 hover:h-24 w-full rounded-lg"
                    style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/gestion.png') }}'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-4">
                        <h3 class=" text-md font-bold">Gestión de usuarios</h3>
                        <p class="hidden group-hover:block mt-2 text-xs text-center">
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <div>
            <a href="">
                <div class="relative group overflow-hidden transition-all duration-300 h-10 hover:h-24 w-full rounded-lg"
                    style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/datos.jpg') }}'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-4">
                        <h3 class=" text-md font-bold">Reportes</h3>
                        <p class="hidden group-hover:block mt-2 text-xs text-center">
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <div>
            <a href="">
                <div class="relative group overflow-hidden transition-all duration-300 h-10 hover:h-24 w-full rounded-lg"
                    style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/alerta.jpg') }}'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-4">
                        <h3 class=" text-md font-bold">Alertas y notificaciones</h3>
                        <p class="hidden group-hover:block mt-2 text-xs text-center">
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Repite los demás elementos del menú aquí -->
    </div>
</aside>

<!-- Script para alternar la visibilidad de la barra lateral -->
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
    }
</script>
