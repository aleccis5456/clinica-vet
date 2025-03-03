<div>    
     <!-- Sidebar -->
     <div class="">             
        @include('includes.sidebar-add-dueno')
    </div>

    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        <p class="pl-1 py-7 text-lg font-semibold">Gestion de Mascotas</p>
        @if ($modalAdd)
            @include('includes.formMascotas.modalAdd')
        @endif

        <div class="mb-4 border border-gray-100 rounded-lg">
            <div class="bg-gray-200 rounded-lg ">
                <div class="p-4">
                    <button wire:click='openModalAdd'
                            class="p-2 border text-white border-gray-900 rounded-lg bg-gray-800 cursor-pointer font-semibold hover:bg-black">
                        Agregar Mascota <span class="">+</span>
                    </button>
                    <span wire:click='openModalEspecies' class="cursor-pointer p-3  bg-gray-400  rounded-lg font-semibold  hover:bg-gray-800 hover:text-gray-100">
                        Agregar Especie +
                    </span>
                </div>     
                @if ($modalEspecies)
                    @include('includes.formMascotas.modalEspecies')           
                @endif                
                <div class="p-3">
                    <!-- Buscador -->
                    <form wire:submit.prevent='filtrar'
                        class=" relative h-12 flex items-center gap-2 bg-gray-100 p-2 rounded-md w-full md:w-1/3 border border-gray-300">
                        <!-- Input de búsqueda -->
                        <input wire:model='search' type="text"
                            class="w-full bg-transparent text-sm px-3 py-2 outline-none focus:ring-2 focus:ring-gray-400 rounded-sm"
                            placeholder="Buscar por nombre">

                        <!-- Botón para limpiar el input -->
                        {{-- @if ($search)
                            <button type="button" wire:click="flag"
                                class="px-1.5 py-0.5 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-200  transition">
                                ✕
                            </button>
                        @endif --}}

                        <!-- Botón de búsqueda -->

                        <button type="submit" class="bg-gray-200 hover:bg-gray-300 transition p-2 rounded-lg">
                            <svg class="w-5 h-5 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 -3 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Tabla -->
                <table class="min-w-full bg-white rounded-b-lg shadow-md hidden md:table">
                    <thead class="bg-gray-200 text-gray-800 border-t border-gray-300">
                        <tr>
                            <th class="py-3 px-4 text-left text-semibold sr-only">foto</th>
                            <th class="py-3 px-4 text-left text-semibold">Nombre</th>
                            <th class="py-3 px-4 text-left text-semibold">Especie</th>
                            <th class="py-3 px-4 text-left text-semibold">Raza</th>
                            <th class="py-3 px-4 text-left text-semibold">Cumpleaños</th>
                            <th class="py-3 px-4 text-left text-semibold">Humano</th>
                            <th class="py-3 px-4 text-left text-semibold">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">
                      @foreach ($mascotas as $mascota)                                              
                            <tr wire:key='{{ $mascota->id }}'
                                class="border-t border-gray-200 hover:bg-gray-100 transition duration-300">
                                <td class="py-3 px-4"><img class="w-12 h-12 rounded-full" src="{{ asset("uploads/mascotas/$mascota->foto") }}" alt=""></td>
                                <td class="py-3 px-4">{{ $mascota->nombre }} ({{ $mascota->genero }})</td>
                                <td class="py-3 px-4"> {{ $mascota->especieN->nombre }} </td>
                                <td class="py-3 px-4"> {{ $mascota->raza }} </td>
                                <td class="py-3 px-4"> {{ App\Helpers\Helper::formatearFecha($mascota->nacimiento) }} </td>
                                <td class="py-3 px-4"> {{ $mascota->dueno->nombre }} </td>
                                <td class="py-3 px-4">
                                    <button wire:click="openModalEdit({{ $mascota->id }})"
                                        class="cursor-pointer text-gray-800 bg-gray-200 hover:bg-gray-300 border border-gray-400 hover:border-gray-600 focus:ring-2 focus:ring-gray-400 rounded-md px-3 py-1 text-sm">
                                        Editar
                                    </button>
                                    <button wire:click='openModalEliminar({{ $mascota->id }})' type="button"
                                        class="ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>  
                        @endforeach                      
                    </tbody>
                </table>

                <!-- Versión móvil -->
                <div class="md:hidden">                    
                    @foreach ($mascotas as $mascota)
                        <div class="border border-gray-300 rounded-lg shadow-md mb-4 p-4 bg-white">                            
                            <div class="flex justify-between mb-2 bg-gray-200 p-1">
                                <span class="font-medium text-gray-800 sr-only">Foto:</span>
                                <span class="text-gray-600"><img class="w-12 h-12 rounded-full" src="{{ asset("uploads/mascotas/$mascota->foto") }}" alt="" srcset=""></span>
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
                                    <span class="text-gray-600">{{ App\Helpers\Helper::formatearFecha($mascota->nacimiento) }}</span>                                
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
                                <button 
                                    type="button"
                                    class="ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                    Eliminar
                                </button>
                            </div>
                                                    
                        </div>
                        @endforeach    
                        {{-- wire:click='borrarDueno({{ $dueno->id }})' --}}                    
                </div>
            </div>
        </div>
    </main>

    @if ($modalEliminar)
        @include('includes.formMascotas.modalEliminar')
    @endif

    @if ($modalEdit)
        @include('includes.formMascotas.modalEdit')
    @endif

</div>
