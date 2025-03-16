<div>
    <div id="confirmarModal" tabindex="-1" class=" fixed top-0 right-0  z-40 flex justify-end w-full h-full bg-black/30 ">
        <div class="relative p-4 w-full max-w-md">

            <button type="button"
                class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                wire:click="resultadosFalse">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Cerrar</span>
            </button>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-lg font-semibold border-b border-gray-300 mb-4 text-gray-800">Resultados</p>
            
                @if (count($clientes) == 0)
                    <p class="text-gray-500 text-center py-4">Sin coincidencias</p>
                @else
                    @foreach ($clientes as $cliente)
                        <button wire:click='select({{ $cliente }})'
                                class="w-full mb-2 flex justify-between items-center p-4 border border-gray-200 rounded-sm hover:border-gray-700 hover:bg-gray-50 focus:border-gray-700 transition-all">
                            <div class="flex flex-col">
                                <p class="text-sm font-medium text-gray-900">{{ $cliente->nombre_rs }}</p>
                                <p class="text-xs text-gray-600">{{ $cliente->ruc_ci }}</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @endforeach
                @endif
            
                <div class="mt-4 space-x-4 flex justify-end">
                    <button wire:click='resultadosFalse'
                            type="button"
                            class="cursor-pointer bg-gray-800 p-3 rounded-lg text-white font-semibold hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 transition-all">
                        Aceptar
                    </button>
            
                    <button wire:click='registroTrue'
                            class="cursor-pointer p-3 border border-gray-400 rounded-lg text-gray-700 font-semibold hover:bg-gray-100 hover:border-gray-600 focus:outline-none transition-all">
                        Registrar Cliente
                    </button>
                </div>
            </div>
            
        </div>
    </div>
</div>
