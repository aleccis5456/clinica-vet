<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0 z-40 flex justify-center items-center w-full h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md">

        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="mascotasBusquedaFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <div
            class="bg-white border border-gray-100 p-8 max-w-md mx-auto shadow-lg rounded-lg max-h-[620px] outline-none overflow-x-hidden overflow-y-auto">
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Seleccionar Mascota</p>
            @if (count($mascotaResultado) == 0)
                <p class="text-gray-500 text-center py-4">Sin coincidencias</p>
            @else
                @foreach ($mascotaResultado as $mascota)
                    <button wire:click="selectMascota({{ $mascota->id }})"
                        class="w-full mb-2 flex justify-between items-center p-4 border border-gray-200 rounded-sm hover:border-gray-700 hover:bg-gray-50 focus:border-gray-700 transition-all">
                        <div class="flex flex-col">
                            <div class="flex gap-1">
                                <div>
                                    <img class="w-12 h-12 rounded-full" src="{{ asset("uploads/mascotas/$mascota->foto") }}" alt="" srcset="">
                                    
                                </div> 
                                <p class="mt-3 font-medium text-lg text-gray-900">{{ $mascota->nombre }}</p>                                    
                                <div>
                                    </div>     
                                <div class="ml-4 ">
                                    <p class="text-sm font-medium text-gray-900">Dueño</p>
                                                                        
                                    <div class="flex">                                        
                                        <p class="text-xs">{{ $mascota->dueno->nombre }}</p>                                        
                                    </div>                                                                             
                                </div>                          
                            </div>
                            
                        </div>
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                @endforeach
            @endif
        </div>
    </div>
</div>
