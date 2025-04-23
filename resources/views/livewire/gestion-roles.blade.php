<div>
    <div class="">
        @include('includes.sidebar-add-dueno')
    </div>


    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        <p class="pl-1 py-7 text-4xl font-semibold">Gestión de Usuarios</p>
        <div class="mb-4 rounded-lg">
            <div class="bg-gray-200 rounded-lg relative">

                <div id="confUser" class="absolute top-0 right-0 group hover:bg-gray-400/60 p-2 m-2 rounded-full cursor-pointer"> 
                    <span class="">
                        <svg class="w-6 h-6 text-gray-900 group-hover:rotate-45 transition duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.536.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z"/>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                          </svg>                                      
                    </span>                    
                </div>  
                <i id="tooltip" class="hidden absolute -top-8 right-5 bg-gray-300 px-1 py-0.5 rounded-lg">
                    <p id="tooltiptext" class="text-gray-800 font-semibold text-sm">Configuración de usuario</p>
                </i>
                <div class="p-4">
                    <button wire:click='openModalRegistro'
                        class="p-2 border text-white border-gray-900 rounded-lg bg-gray-800 cursor-pointer font-semibold hover:font-bold">
                        Registrar Usuario <span class="">+</span>
                    </button>
                    <button wire:click='openModalRol'
                    class="p-2 border border-gray-700 text-gray-900 rounded-lg bg-gray-200 cursor-pointer font-semibold hover:bg-gray-300 hover:font-bold">
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
            </div>

            <div class="pt-2 ">
                <table class="min-w-full bg-white rounded-lg shadow-md hidden md:table">
                    <thead class="bg-gray-200 text-gray-800 rounded-lg">
                        <tr>
                            <th class="py-3 px-4 text-left text-semibold">Nombre</th>
                            <th class="py-3 px-4 text-left text-semibold">Email</th>
                            <th class="py-3 px-4 text-left text-semibold">Rol</th>                            
                            <th class="py-3 px-4 text-left text-semibold">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">
                        @foreach ($users as $user)                                                                                                                
                            <tr wire:key='{{ $user->id }}'
                                class="hover:bg-gray-100 transition duration-300">
                                <td class="py-3 px-4">{{ $user->name }}</td>
                                <td class="py-3 px-4">                                    
                                    @if ($user->email != "sin@definir"."$user->admin_id".".com")                                                                        
                                        {{ $user->email }}
                                    @endif                                     
                                </td>
                                <td class="py-3 px-4">                                    
                                    {{-- {{ json_encode(dd($roles)) }} --}}
                                    @foreach ($roles as $rol)                                    
                                    
                                        @if ($rol->id == $user->rol_id)
                                            {{ $rol->name }}
                                        @endif
                                    @endforeach
                                </td>                                
                                <td class="py-3 px-4 font-semibold">
                                    @if ($user->email != "sin@definir"."$user->admin_id".".com")
                                    <button wire:click="editUserTrue({{ $user->id }})"
                                        class="cursor-pointer text-gray-800 bg-gray-200 hover:bg-gray-300  focus:ring-2 focus:ring-gray-400 rounded-md px-3 py-1 text-sm">
                                        Editar
                                    </button>
                                    <button wire:click='eliminarUserTrue({{ $user->id }})' 
                                        type="button"
                                        class="ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                        Eliminar
                                    </button>                                                                    
                                    @endif                                     
                                </td>
                            </tr>  
                        @endforeach                      
                    </tbody>
                </table>
            </div>

            <!-- Muestra los datos en dispositivos móviles -->
            <div class="md:hidden">
                @foreach ($users as $user)
                    <div  wire:key='{{ $user->id }}'class="border border-gray-300 rounded-lg shadow-md mb-4 p-4 bg-white">
                        <div class="flex justify-between mb-2 bg-white p-1">
                            <span class="font-medium text-gray-800">Nombre:</span>
                            <span class="text-gray-600">{{ $user->nombre }}</span>
                        </div>
                        <div class="flex justify-between mb-2 bg-gray-200 p-1">
                            <span class="font-medium text-gray-800">Email:</span>
                            <span class="text-gray-600">                                
                                @if ($user->mail == "sin@definir"."{{ Auth::user()->id }}".".com")
                                    sad
                                @endif 
                                f;sdljk 
                            </span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium text-gray-800">Telefono:</span>
                            <span class="text-gray-600"></span>
                        </div>
                        <div class="flex justify-between mb-2 bg-gray-200 p-1">
                            <span class="font-medium text-gray-800">Mascota:</span>
                            
                                <span class="text-gray-600"></span>
                            
                        </div>
                        <div class="flex justify-end space-x-2 ">
                            <button wire:click="editUserTrue({{ $user->id }})"
                                type="button"
                                class="cursor-pointer text-gray-800 bg-gray-200 hover:bg-gray-300 border border-gray-400 hover:border-gray-600 focus:ring-2 focus:ring-gray-400 rounded-md px-3 py-1 text-sm">
                                Editar
                            </button>
                            <button wire:click='eliminarUserTrue({{ $user->id }})'
                                type="button"
                                class="cursor-pointer ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                Eliminar
                            </button>
                        </div>
                    </div>
                    {{-- wire:click='borrarDueno({{ $dueno->id }})' --}}
                @endforeach
            </div>
    </main>
    @if ($modalRol)
        @include('includes.gestion-roles.modalRoles')
    @endif

    @if ($modalRegistro)
        @include('includes.gestion-roles.modalRegistro')        
    @endif

    @if ($configRoles)
        @include('includes.gestion-roles.modalConfigRoles')
    @endif

    @if ($editUser)
        @include('includes.gestion-roles.modal-edit-user')
    @endif

    @if ($eliminarUser)
        @include('includes.gestion-roles.modal-eliminar-user')
    @endif

    <script>
        const confUser = document.getElementById('confUser');
        const tooltip = document.getElementById('tooltip');

        confUser.addEventListener('mouseover', function() {
            console.log('hover');
            setTimeout(() => {
                tooltip.classList.remove('hidden');
            }, 1000);            
        });
        confUser.addEventListener('mouseout', function() {
            console.log('out');
            setTimeout(() => {
                tooltip.classList.add('hidden');
            }, 1000 );            
        });
    </script>
</div>
