<div>
    <!-- Sidebar -->
    <div class="">
        @include('includes.sidebar-add-dueno')
    </div>


    <main class="ml-0 md:ml-64 md:pl-24 md:pt-2 pt-16 pl-2 pr-4">
        <div class="grid grid-cols-1 gap-4">                        
            <div class="">                               
                @include('includes.formduenos.formulario')                
            </div>            
            <div class="mb-4">
                <div class="overflow-x-auto rounded-lg">
                    <!-- Tabla -->
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md hidden md:table">                        
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left font-medium">Nombre</th>
                                <th class="py-3 px-4 text-left font-medium">Email</th>
                                <th class="py-3 px-4 text-left font-medium">Telefono</th>
                                <th class="py-3 px-4 text-left font-medium">Mascota</th>
                                <th class="py-3 px-4 text-left font-medium">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-800">
                            @foreach ($duenos as $dueno)
                                <tr wire:key='{{ $dueno->id }}'
                                    class="border-t border-gray-200 hover:bg-gray-100 transition duration-300">
                                    <td class="py-3 px-4">{{ $dueno->nombre }}</td>
                                    <td class="py-3 px-4">{{ $dueno->email }}</td>
                                    <td class="py-3 px-4">{{ $dueno->telefono }}</td>
                                    <td class="py-3 px-4">
                                        @foreach ($dueno->mascotas as $mascota)
                                            {{ $mascota->nombre ?? 'sin mascota' }}
                                        @endforeach
                                    </td>
                                    <td class="py-3 px-4">
                                        <button
                                            wire:click="openModalEdit({{ $dueno->id }})"                                    
                                            class="cursor-pointer text-gray-800 bg-gray-200 hover:bg-gray-300 border border-gray-400 hover:border-gray-600 focus:ring-2 focus:ring-gray-400 rounded-md px-3 py-1 text-sm">
                                            Editar
                                        </button>
                                        <button                                            
                                            wire:click='borrarDueno({{ $dueno->id }})'                                            
                                            type="button"
                                            class="ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm"
                                            wire:confirm='Estas seguro?'>                                            
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
                            <div class="border border-gray-300 rounded-lg shadow-md mb-4 p-4">
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
                                    <button
                                        class="text-white bg-green-500 hover:bg-green-600 focus:ring-2 focus:ring-green-300 rounded-md px-3 py-1 text-sm">
                                        Editar
                                    </button>
                                    <button wire:confirm="Estas seguro de borrar el dueno?"
                                        type="button"                          
                                        class="text-white bg-red-500 hover:bg-red-600 focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </main>

    <!-- modal edit -->
    @if ($modalEdit)
        @include('includes.formduenos.modalEdit')
    @endif    
</div>
