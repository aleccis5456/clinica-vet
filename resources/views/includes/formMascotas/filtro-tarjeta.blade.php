<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0  z-40 flex justify-center items-center w-full h-full bg-black/50 outline-none overflow-x-hidden overflow-y-auto">
    <div class="relative p-4 w-lg md:w-md ">

        <button type="button"
            class="cursor-pointer m-2 absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="filtroFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>
        <div class="h-auto w-full bg-white p-5 rounded-lg">
            <form wire:submit.prevent="filtrarVacunas" class="w-full">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Filtrar por fecha</h2>
                <div class="p-4">
                    <div class="mb-4">
                        <label for="fecha_desde" class="block text-sm font-medium text-gray-700">Desde</label>
                        <input wire:model="desde" type="date" id="fecha_desde" name="fecha_desde"
                            class="block p-3 w-full pl-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 transition duration-150 ease-in-out" />
                    </div>
                    <div class="mb-4">
                        <label for="fecha_hasta" class="block text-sm font-medium text-gray-700">Hasta</label>
                        <input wire:model='hasta' type="date" id="fecha_hasta" name="fecha_hasta"
                            class="block p-3 w-full pl-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 transition duration-150 ease-in-out" />
                    </div>
                    <div class="w-full justify-center flex">
                        <button type="submit"
                            class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700 cursor-pointer">Filtrar</button>
                    </div>
                </div>
            </form>

            <div>
                <p class="cursor-pointer bg-red-400 font-semibold  text-white py-2 px-4 rounded-md mt-4">Exportar
                    tarjeta a PDF</p>
            </div>
        </div>
    </div>
</div>
