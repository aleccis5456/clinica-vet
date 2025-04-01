<div>
    <div id="confirmarModal" tabindex="-1"
        class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/50">
        <div class="relative p-4 w-full max-w-md">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Botón para cerrar -->
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                    wire:click="closeModalEliminar">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Cerrar</span>
                </button>
                <!-- Contenido -->
                <div class="p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-semibold text-gray-800">
                        ¿Estás seguro de eliminar?
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">
                        Esta acción no se puede deshacer.
                    </p>
                    <button wire:click='deleteProducto'
                        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Sí, eliminar
                    </button>
                    <button wire:click="closeModalEliminar"
                        class="ml-3 text-gray-800 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>