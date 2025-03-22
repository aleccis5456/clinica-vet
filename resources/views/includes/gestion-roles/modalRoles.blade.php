<div id="" tabindex="-1"
    class="outline-none overflow-x-hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/50 ">
    <div class="relative p-4 w-full max-w-md max-h-[650px]">
        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="closeModalRol">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <form wire:submit='crearRol'
            class="bg-white border border-gray-100 p-8 max-w-md mx-auto shadow-lg  {{ $tablaRoles == true ? 'rounded-t-lg' : 'rounded-lg' }} outline-none overflow-x-hidden overflow-y-auto">
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Agregar Rol</p>
            <!--  Campo para relacionar don una persona -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Nombre</label>
                <input type="text" wire:model='rolName'
                    class="select2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                <p>
                    @error('rolName')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <button type="submit"
                class="w-full bg-gray-800 text-white font-medium py-2 rounded-md hover:bg-black transition duration-300">
                Guardar
            </button>

            @if ($tablaRoles)
                <button type="button" wire:click='closeTablaRoles'
                    class="mt-2 w-full font-medium py-2 rounded-md border border-gray-300 hover:border-gray-500 hover:bg-gray-200">
                    Ocultar Tabla
                </button>
            @else
                <button type="button" wire:click='openTablaRoles'
                    class="mt-2 w-full font-medium py-2 rounded-md border border-gray-300 hover:border-gray-500 hover:bg-gray-200">
                    Ver Roles
                </button>
            @endif
        </form>


        @if ($tablaRoles)
            <div class="max-h-[300px] overflow-y-auto rounded-b-lg">
                <table class="min-w-full bg-white rounded-b-lg shadow-md ">
                    <thead class="bg-gray-200 text-gray-800 border-t border-gray-300 sticky top-0">
                        <tr>
                            <th class="py-3 px-4 text-left text-semibold">Roles</th>
                            <th class="py-3 px-4 text-left text-semibold sr-only">Acción</th>                            
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">
                        @foreach ($roles as $rol)
                        <tr wire:key='{{ $rol->id }}' class="border-t border-gray-200 hover:bg-gray-100 transition duration-300">
                            <td class="py-3 px-4">{{ $rol->name }}</td>
                            <td class="py-3 px-4 font-semibold">
                                <div class="">
                                    <button wire:click='configRolesTrue({{ $rol->id }})' type="button"
                                    class="relative top-2 text-xs cursor-pointer ml-2 text-gray-800 bg-gray-300 hover:bg-gray-200 focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1">
                                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.536.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z"/>
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                      </svg>                                      
                                </button>
                                <button wire:click='eliminarRol({{ $rol->id }})' type="button"
                                    class="cursor-pointer ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                    Eliminar
                                </button >           
                                </div>                                                     
                            </td>
                        </tr>
                        @endforeach                        
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
