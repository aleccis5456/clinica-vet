<div class="">
    <!-- Sidebar -->
    <div class="">
        @include('includes.sidebar-add-dueno')
    </div>
    {{-- backdrop-blur-xs --}}
    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        <p class="pl-1 py-7 text-4xl font-semibold">Gestion de Duenos</p>
        @if ($modalAddDueno)
            @include('includes.formduenos.formulario')
        @endif

        <div class="mb-4 border border-gray-100 rounded-lg">
            <div class="bg-gray-200 rounded-lg ">
                <div class="p-4">
                    <button wire:click='openModalAddDueno'
                            class="p-2 border text-white border-gray-900 rounded-lg bg-gray-800 cursor-pointer font-semibold hover:font-bold">
                        Agregar Dueno <span class="">+</span>
                    </button>
                </div>                
                <div class="p-3">
                    <!-- Buscador -->
                    <form wire:submit.prevent='filtrar'
                        class=" relative h-12 flex items-center gap-2 bg-gray-100 p-2 rounded-md w-full md:w-1/3 border border-gray-300">
                        <!-- Input de búsqueda -->
                        <input wire:model='search' type="text"
                            class="w-full bg-transparent text-sm px-3 py-2 outline-none focus:ring-2 focus:ring-gray-400 rounded-sm"
                            placeholder="Buscar por nombre">

                        <!-- Botón para limpiar el input -->
                        @if ($search)
                            <button type="button" wire:click="flag"
                                class="px-1.5 py-0.5 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-200  transition">
                                ✕
                            </button>
                        @endif

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
                            <th class="py-3 px-4 text-left text-semibold">Nombre</th>
                            <th class="py-3 px-4 text-left text-semibold">Email</th>
                            <th class="py-3 px-4 text-left text-semibold">Telefono</th>
                            <th class="py-3 px-4 text-left text-semibold">Mascota</th>
                            <th class="py-3 px-4 text-left text-semibold">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">
                        @foreach ($this->duenos as $dueno)
                            <tr wire:key='{{ $dueno->id }}'
                                class="border-t border-gray-200 hover:bg-gray-100 transition duration-300">
                                <td class="py-3 px-4">{{ $dueno->nombre }}</td>
                                <td class="py-3 px-4">{{ $dueno->email }}</td>
                                <td class="py-3 px-4">{{ $dueno->telefono }}</td>
                                <td class="py-3 px-4">
                                    @foreach ($dueno->mascotas as $mascota)
                                        <div class="flex items-center space-x-2">
                                            <span>- {{ $mascota->nombre ?? 'Sin mascota' }}</span>
                                            @if ($mascota->foto)
                                                <img class="w-12 h-12 rounded-full" src="{{ asset('uploads/mascotas/' . $mascota->foto) }}" alt="Foto de {{ $mascota->nombre }}">
                                            @else
                                                <span>Sin foto</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </td>
                                
                                <td class="py-3 px-4 font-semibold">
                                    <button wire:click="openModalEdit({{ $dueno->id }})"
                                        class="cursor-pointer text-gray-800 bg-gray-200 hover:bg-gray-300  focus:ring-2 focus:ring-gray-400 rounded-md px-3 py-1 text-sm">
                                        Editar
                                    </button>
                                    <button wire:click='opneModalEliminar({{ $dueno->id }})' type="button"
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
                    @foreach ($duenos as $dueno)
                        <div class="border border-gray-300 rounded-lg shadow-md mb-4 p-4 bg-white">
                            <div class="flex justify-between mb-2 bg-white p-1">
                                <span class="font-medium text-gray-800">Nombre:</span>
                                <span class="text-gray-600">{{ $dueno->nombre }}</span>
                            </div>
                            <div class="flex justify-between mb-2 bg-gray-200 p-1">
                                <span class="font-medium text-gray-800">Email:</span>
                                <span class="text-gray-600">{{ $dueno->email }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="font-medium text-gray-800">Telefono:</span>
                                <span class="text-gray-600">{{ $dueno->telefono }}</span>
                            </div>
                            <div class="flex justify-between mb-2 bg-gray-200 p-1">
                                <span class="font-medium text-gray-800">Mascota:</span>
                                @foreach ($dueno->mascotas as $mascota)
                                    <span class="text-gray-600">{{ $mascota->nombre }}</span>
                                @endforeach
                            </div>
                            <div class="flex justify-end space-x-2 ">
                                <button wire:click="openModalEdit({{ $dueno->id }})"
                                    class="cursor-pointer text-gray-800 bg-gray-200 hover:bg-gray-300 border border-gray-400 hover:border-gray-600 focus:ring-2 focus:ring-gray-400 rounded-md px-3 py-1 text-sm">
                                    Editar
                                </button>
                                <button wire:click='opneModalEliminar' wire:model='duenoToDelete={{ $dueno->id }}'
                                    type="button"
                                    class="ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                        {{-- wire:click='borrarDueno({{ $dueno->id }})' --}}
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <!-- modal edit -->
    @if ($modalEdit)
        @include('includes.formduenos.modalEdit')
    @endif


    @if ($modalEliminar)
        @include('includes.formduenos.modalEliminar')
    @endif
</div>
