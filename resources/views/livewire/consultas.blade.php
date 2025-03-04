<div class="">
    <!-- Sidebar -->
    <div class="">
        @include('includes.sidebar-add-dueno')
    </div>


    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        <p class="pl-1 py-7 text-4xl font-semibold">Consultas <span class="text-lg"> | Historial clinico</span></p>
        <div class="mb-4 rounded-lg">
            <div class="bg-gray-200 rounded-lg ">
                <div class="p-4">
                    <button wire:click='openModalAddDueno'
                        class="p-2 border text-white border-gray-900 rounded-lg bg-gray-800 cursor-pointer font-semibold hover:font-bold">
                        Registrar Consulta <span class="">+</span>
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

            <div class="py-10 grid grid-cols-2 md:grid-cols-4 gap-4">
                
                <!-- Card 1 -->
                @foreach ($mascotas as $mascota)
                <div
                class="bg-gray-100 shadow-md rounded-lg group overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-lg hover:bg-gray-200">
                <div class="relative">
                    <img class="rounded-t-lg w-full h-48 object-cover"
                        src="{{ asset("uploads/mascotas/$mascota->foto") }}" alt="Grisho" />
                    <div class="absolute bottom-0 left-0 p-2 bg-gray-900/50 text-white text-xs rounded-br-lg">
                        {{ $mascota->especieN->nombre }} | {{ $mascota->raza }} | {{ App\Helpers\Helper::edad($mascota->nacimiento) }} años
                    </div>
                </div>
                <div class="p-4 flex flex-col gap-2">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-semibold">{{ $mascota->nombre }}  <span class="text-xs text-gray-600 font-normal">| {{ $mascota->genero }}</span></h2>
                        <span class="text-xs text-gray-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $mascota->dueno->nombre }}
                        </span>
                    </div>
                    <div class="flex gap-4 text-gray-600 text-sm">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Última: 12-01-2025</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span>Registro: {{ App\Helpers\Helper::formatearFecha($mascota->created_at) }}</span>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <a href="#" class="text-blue-500 text-sm hover:underline">Ver historial completo</a>
                    </div>
                </div>
            </div>
                @endforeach
               
            </div>
