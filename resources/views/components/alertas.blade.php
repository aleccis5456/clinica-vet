<div>        
    <div>
        @if (session('agregado'))
            <div id="alerta" tabindex="-1"
                class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/50">
                <div class="relative p-4 w-full max-w-md">
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Botón para cerrar -->
                        <button type="button"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                            onclick="closeAlert()">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Cerrar</span>
                        </button>
                        <!-- Contenido -->
                        <div class="p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-500 w-12 h-12" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 12.75l3 3 6-6" />
                                <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="2" />
                            </svg>
                            <h3 class="mb-5 text-lg font-semibold text-gray-800">
                                ¡Agregado correctamente!
                            </h3>
                            <p class="mb-5 text-sm text-gray-600">
                                {{ session('agregado') }}
                            </p>
                            <button onclick="closeAlert()"
                                class="text-white bg-gray-800 hover:bg-black focus:ring-4 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Aceptar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function closeAlert() {
                    const modal = document.getElementById('alerta');
                    if (modal) {
                        modal.style.transition = 'opacity 0.5s';
                        modal.style.opacity = '0';
                        setTimeout(() => modal.remove(), 500); // Remueve el elemento después de la transición
                    }
                }
                // Cierra automáticamente después de 3 segundos
                setTimeout(() => closeAlert(), 5000);
            </script>
        @endif
    </div>

    {{-- edit --}}
    <div>
        @if (session('editado'))
            <div id="alerta" tabindex="-1"
                class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/50">
                <div class="relative p-4 w-full max-w-md">
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Botón para cerrar -->
                        <button type="button"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                            onclick="closeAlert()">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Cerrar</span>
                        </button>
                        <!-- Contenido -->
                        <div class="p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-500 w-12 h-12" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 12.75l3 3 6-6" />
                                <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="2" />
                            </svg>
                            <h3 class="mb-5 text-lg font-semibold text-gray-800">
                                ¡Actualizacion completado!
                            </h3>
                            <p class="mb-5 text-sm text-gray-600">
                                {{ session('editado') }}
                            </p>
                            <button onclick="closeAlert()"
                                class="text-white bg-gray-800 hover:bg-black focus:ring-4 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Aceptar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function closeAlert() {
                    const modal = document.getElementById('alerta');
                    if (modal) {
                        modal.style.transition = 'opacity 0.5s';
                        modal.style.opacity = '0';
                        setTimeout(() => modal.remove(), 500); // Remueve el elemento después de la transición
                    }
                }
                // Cierra automáticamente después de 3 segundos
                setTimeout(() => closeAlert(), 5000);
            </script>
        @endif
    </div>



    {{-- eliminacion --}}
    <div>
        @if (session('eliminado'))
            <div id="alerta" tabindex="-1"
                class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/50">
                <div class="relative p-4 w-full max-w-md">
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Botón para cerrar -->
                        <button type="button"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                            onclick="closeAlert()">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Cerrar</span>
                        </button>
                        <!-- Contenido -->
                        <div class="p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-500 w-12 h-12" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 12.75l3 3 6-6" />
                                <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="2" />
                            </svg>
                            <h3 class="mb-5 text-lg font-semibold text-gray-800">
                                ¡Elemento eliminado!
                            </h3>
                            <p class="mb-5 text-sm text-gray-600">
                                {{ session('eliminado') }}
                            </p> 
                            <button onclick="closeAlert()"
                                class="text-white bg-gray-800 hover:bg-black focus:ring-4 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Aceptar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function closeAlert() {
                    const modal = document.getElementById('alerta');
                    if (modal) {
                        modal.style.transition = 'opacity 0.5s';
                        modal.style.opacity = '0';
                        setTimeout(() => modal.remove(), 500);
                    }
                }
                setTimeout(() => closeAlert(), 5000);
            </script>
        @endif
    </div>
    
</div>