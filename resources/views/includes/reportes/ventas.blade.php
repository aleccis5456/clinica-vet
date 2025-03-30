<div id="confirmarModal" tabindex="-1"
    class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md">

        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="fechasFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>
        {{--  --}}
        <form action="{{ route('reporte.pdf') }}"
                class="bg-white border border-gray-100 p-4 max-w-md mx-auto shadow-lg rounded-lg">
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Elegir Rango de fecha</p>
            <div class="flex flex-col space-y-2">
                <label class="mx-auto font-semibold" for="">Desde</label>
                <input name="desde"
                    class="p-2 bg-gray-300 rounded-lg max-w-[150px] mx-auto"  type="date">

                <label class="mx-auto font-semibold" for="">hasta</label>
                <input name="hasta"
                class="p-2 bg-gray-300 mb-5 rounded-lg max-w-[150px] mx-auto"  type="date">
            </div>            
            <div class="">
                <button type="submit" 
                        class="w-full px-6 py-2 bg-gray-800 text-white font-medium rounded-md hover:bg-gray-700 transition duration-300">
                    Aceptar
                </button>
            </div>
        </form>

    </div>

</div>