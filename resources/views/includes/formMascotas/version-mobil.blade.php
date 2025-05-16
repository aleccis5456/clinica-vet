 <div class="md:hidden">
                @foreach ($mascotas as $mascota)
                    <div class="border border-gray-300 rounded-lg shadow-md mb-4 p-4 bg-white">
                        <div class="flex justify-between mb-2 bg-gray-200 p-1">
                            <span class="font-medium text-gray-800 sr-only">Foto:</span>
                            <span class="text-gray-600"><img class="w-12 h-12 rounded-full"
                                    src="{{ asset("uploads/mascotas/$mascota->foto") }}" alt=""
                                    srcset=""></span>
                        </div>
                        <div class="flex justify-between mb-2 bg-white p-1">
                            <span class="font-medium text-gray-800">Nombre:</span>
                            <span class="text-gray-600">{{ $mascota->nombre }}</span>
                        </div>
                        <div class="flex justify-between mb-2 bg-gray-200 p-1">
                            <span class="font-medium text-gray-800">Especie:</span>
                            <span class="text-gray-600">{{ $mascota->especieN->nombre }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium text-gray-800">Raza:</span>
                            <span class="text-gray-600">{{ $mascota->raza }}</span>
                        </div>
                        <div class="flex justify-between mb-2 bg-gray-200 p-1">
                            <span class="font-medium text-gray-800">Cumpleaños:</span>
                            <span
                                class="text-gray-600">{{ App\Helpers\Helper::formatearFecha($mascota->nacimiento) }}</span>
                        </div>
                        <div class="flex justify-between mb-2 bg-gray-200 p-1">
                            <span class="font-medium text-gray-800">Humano:</span>
                            <span class="text-gray-600">{{ $mascota->dueno->nombre }}</span>
                        </div>
                        <div class="flex justify-end space-x-2 ">
                            <button wire:click=""
                                class="cursor-pointer text-gray-800 bg-gray-200 hover:bg-gray-300 border border-gray-400 hover:border-gray-600 focus:ring-2 focus:ring-gray-400 rounded-md px-3 py-1 text-sm">
                                Editar
                            </button>
                            
                            <button type="button"
                                class="ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                Eliminar
                            </button>
                        </div>
                    </div>
                @endforeach                
            </div>