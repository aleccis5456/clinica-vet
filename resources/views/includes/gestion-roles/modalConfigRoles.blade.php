<div id="" tabindex="-1"
    class="outline-none overflow-x-hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/50 ">
    <div class="relative p-4 w-full max-w-md max-h-[650px]">
        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="configRolesFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <form wire:submit='establecerPermisos'
            class="bg-white border border-gray-100 p-8 max-w-md mx-auto shadow-lg  rounded-lg outline-none overflow-x-hidden overflow-y-auto">
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Configurar Rol: {{ $rolToConf->name }}</p>
            <input type="hidden" name="">
            @foreach ($permisos as $permiso)
                <div class="flex">
                    <label for="permiso-{{ $permiso->id }}"
                        class="cursor-pointer w-full hover:bg-gray-200 p-2 rounded mb-0.5 border  border-gray-300 {{ in_array($permiso->id, $permisosRoles) ? 'bg-gray-100' : 'bg-white' }}">
                        <input wire:model='permisosRoles' wire:click='setPermisos'                             
                            type="checkbox"
                            id="permiso-{{ $permiso->id }}" value="{{ $permiso->id }}"
                            class="{{ in_array($permiso->id, $permisosRoles) ? '' : 'hidden' }}">
                        {{ $permiso->name }}
                    </label>
                </div>
            @endforeach

            <div class="mt-5">
                <button type="submit"
                    class="cursor-pointer ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1">
                    Confirmar
                </button>
            </div>
        </form>

    </div>

</div>
