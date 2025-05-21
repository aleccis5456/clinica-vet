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

            <div class="relative bg-red-100 hover:bg-red-500 flex justify-between pl-6  w-[80%] mx-auto mt-4 rounded-lg group transition-all duration-300">
                <p class="cursor-pointer font-semibold  text-red-500 group-hover:text-red-100 px-2 py-2 transition-all duration-200">
                    Exportar tarjeta a PDF
                </p>

                <button class="cursor-pointer bg-red-500 text-white rounded-md px-2 py-1  hover:bg-red-100  hover:text-red-500 transition-all duration-200">
                    <svg class="w-8 h-8" aria-hidden="true" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
