<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0  z-40 flex justify-center items-center w-full h-full bg-black/50 outline-none overflow-x-hidden overflow-y-auto">
    <div class="relative p-4 w-lg md:w-5xl ">

        <button type="button"
            class="m-2 absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="historialFalse({{ $detalleProducto->id }})">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <div class="bg-white border border-gray-200 rounded-lg shadow-lg mx-auto max-w-5xl overflow-hidden ">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Historial de ventas</h2>
                <p>{{ $detalleProducto->nombre }}</p>

            </div>
        </div>

    </div>

</div>