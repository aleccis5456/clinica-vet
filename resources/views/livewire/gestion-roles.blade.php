<div>
    <div class="">
        @include('includes.sidebar-add-dueno')
    </div>


    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        <p class="pl-1 py-7 text-4xl font-semibold">Gestion de Usuarios</p>
        <div class="mb-4 rounded-lg">
            <div class="bg-gray-200 rounded-lg ">
                <div class="p-4">
                    <button wire:click='openModalRegistro'
                        class="p-2 border text-white border-gray-900 rounded-lg bg-gray-800 cursor-pointer font-semibold hover:font-bold">
                        Registrar Usuario <span class="">+</span>
                    </button>
                    <button wire:click='openModalRol'
                        class="p-2 border text-white border-gray-800 rounded-lg bg-gray-700 cursor-pointer font-semibold hover:font-bold">
                        Registrar Rol <span class="">+</span>
                    </button>
                </div>
                <div class="p-3">
                    <form wire:submit.prevent=''
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
            </div>

            <div class="pt-2 ">
                <table class="min-w-full bg-white rounded-lg shadow-md hidden md:table">
                    <thead class="bg-gray-200 text-gray-800 rounded-lg">
                        <tr>
                            <th class="py-3 px-4 text-left text-semibold">Nombre</th>
                            <th class="py-3 px-4 text-left text-semibold">Email</th>
                            <th class="py-3 px-4 text-left text-semibold">Telefono</th>
                            <th class="py-3 px-4 text-left text-semibold">Mascota</th>
                            <th class="py-3 px-4 text-left text-semibold">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">
                        
                            <tr wire:key=''
                                class="hover:bg-gray-100 transition duration-300">
                                <td class="py-3 px-4"></td>
                                <td class="py-3 px-4"></td>
                                <td class="py-3 px-4"></td>
                                <td class="py-3 px-4"></td>
                                
                                <td class="py-3 px-4 font-semibold">
                                    <button wire:click=""
                                        class="cursor-pointer text-gray-800 bg-gray-200 hover:bg-gray-300  focus:ring-2 focus:ring-gray-400 rounded-md px-3 py-1 text-sm">
                                        Editar
                                    </button>
                                    <button wire:click='' type="button"
                                        class="ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>                        
                    </tbody>
                </table>
            </div>
    </main>
    @if ($modalRol)
        @include('includes.gestion-roles.modalRoles')
    @endif

    @if ($modalRegistro)
        @include('includes.gestion-roles.modalRegistro')        
    @endif
</div>
