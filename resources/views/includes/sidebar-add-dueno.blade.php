
    <div>    
        <button class="fixed top-4 left-4 bg-white border border-gray-100 rounded-b-md text-gray-800 focus:text-white p-2 rounded md:hidden z-auto" onclick="toggleSidebar()">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
            </svg>
        </button>              
    </div>  

<!-- Aside (barra lateral) -->
<aside
    class=" fixed top-0 left-0 w-3/4 md:w-80 h-full bg-gray-100  border border-gray-200  roundend-lg p-4 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-20 overflow-y-auto"
    id="sidebar">

    <p class="text-center pt-10 md:pt-4 text-xl font-semibold transition-all duration-300 hover:scale-105">
        <a wire:navigate href="{{ route('index') }}">Clinica Veterinaria</a>
    </p>
    <!-- Botón de cerrar (solo visible en móviles) -->
    <button class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 md:hidden" onclick="toggleSidebar()">
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <!-- Menú -->
    <div class="mt-10 space-y-0.5">
        <!-- Card 1 -->
        <div>
            @if (Route::is('add.dueno'))
            <a wire:navigate href="{{ route('add.mascota') }}">
            @elseif (Route::is('add.mascota'))
            <a wire:navigate href="{{ route('add.dueno') }}">        
            @endif                        
                <div class="relative group overflow-hidden transition-all duration-300 h-10 hover:h-24  md:w-full rounded-lg"
                    style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/gestion-pacientes.jpg') }}'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-4">
                        <h3 class=" text-md font-bold">Gestión de Pacientes</h3>
                        @if (Route::is('add.dueno'))
                            <p class="hidden group-hover:block mt-2 text-xs text-center">Registro de mascotas</p>
                        @elseif (Route::is('add.mascota'))
                            <p class="hidden group-hover:block mt-2 text-xs text-center">Registro de dueno</p>
                        @endif                        
                    </div>
                </div>
            </a>
        </div>        

        <div>
            <a href="">
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
                <div class="relative group overflow-hidden transition-all duration-300 h-10 hover:h-24 w-full rounded-lg"
                    style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/pago.jpg') }}'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-4">
                        <h3 class=" text-md font-bold">Caja</h3>
                        <p class="hidden group-hover:block mt-2 text-xs text-center">
                        </p>
                    </div>
                </div>
            </a>
        </div>  

        <div>
            <a href="">
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
            <a href="">
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
        
    </div>
</aside>

<!-- Contenido principal -->


<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
    }
</script>
