<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0  z-40 flex justify-center items-center w-full h-full bg-black/50 outline-none overflow-x-hidden overflow-y-auto">
    <div class="relative p-4 w-lg md:w-md ">

        <button type="button"
            class="cursor-pointer m-2 absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="addNotaFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>
        <div class="h-auto w-full bg-white p-6 rounded-lg">
            <form wire:submit.prevent="guardarNota({{ $vacuna->id }})" class="w-full">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="nota">Agregar Nota</label>
                    <textarea wire:model="nota" id="nota" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Escribe tu nota..."></textarea>
                    @error('nota')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                    <button 
                        class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mt-4"
                        type="submit">
                        Guardar
                    </button>
                   <div wire:loading  
                        class="absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-gray-800/10">
                        Guardando...
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>
