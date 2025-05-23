<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0 z-40 flex justify-center items-center w-full h-full bg-black/30 outline-none overflow-x-hidden overflow-y-auto">
    <div class="relative p-4 w-lg md:w-md ">

        <button type="button"
            class="cursor-pointer m-2 absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="serachvFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>
        <div class="h-auto w-full bg-white p-6 rounded-xl shadow-lg max-w-md mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Buscar Vacuna</h2>

            <form wire:submit.prevent="searchVacunas" class="w-full space-y-6">
                <div class="flex items-center border border-gray-300 rounded-lg px-3 py-1 bg-gray-50">
                    <input type="text" wire:model="searchInput" placeholder="Buscar producto..."
                        class="w-full bg-transparent outline-none text-gray-700" autocomplete="off">
                    <button type="submit" class="ml-2 text-white bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
