<div>
    <div class="">
        @include('includes.sidebar-add-dueno')
    </div>

    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        <p class="pl-1 py-7 text-4xl font-semibold">Inventario </p>
        <div class="mb-4 rounded-lg">
            <div class="bg-gray-200 rounded-lg ">
                <div class="p-4">
                    <button wire:click='openModalAddDueno'
                        class="p-2 border text-white border-gray-900 rounded-lg bg-gray-800 cursor-pointer font-semibold hover:font-bold">
                        Agregar Producto <span class="">+</span>
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
        </div>
    </main>
</div>
