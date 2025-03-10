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
                    <button wire:click='opneAddConsulta'
                        class="p-2 border border-gray-900 text-white rounded-lg bg-gray-800 cursor-pointer font-semibold hover:bg-gray-700 hover:font-bold">
                        Registrar Consulta <span>+</span>
                    </button>

                    <button wire:click='openTipoConsulta'
                        class="p-2 border border-gray-700 text-gray-900 rounded-lg bg-gray-200 cursor-pointer font-semibold hover:bg-gray-300 hover:font-bold">

                        Agregar Tipo de Consulta <span>+</span>
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

            <div class="py-10 grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $estados = [
                        'Agendado' => 'bg-[#007bff]',
                        'Reprogramado' => 'bg-[#6f42c1]',
                        'Pendiente' => 'bg-[#fd7e14]',
                        'En Espera' => 'bg-[#ffc107]',
                        'En consultorio' => 'bg-[#28a745]',
                        'Finalizado' => 'bg-[#155724]',
                        'No asistió' => 'bg-[#6c757d]',
                        'Cancelado' => 'bg-[#dc3545]',
                    ];
                @endphp

                <!-- Card 1 -->
                @foreach ($consultas as $consulta)
                    <div
                        class="max-w-[250px] bg-gray-100 shadow-md rounded-lg group overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-lg hover:bg-gray-200 relative">
                        <!-- Tag de estado -->
                        <select name="" id="" wire:change='updateEstado({{ $consulta->id }}, $event.target.value)'
                            class="cursor-pointer estado-select absolute top-2 left-2 z-10 px-3 py-1 rounded-full text-xs text-white font-semibold
                        {{ $estados[$consulta->estado] ?? 'bg-gray-300' }}"
                            onchange="cambiarColor(this)">
                            @foreach ($estados as $estado => $color)
                                <option value="{{ $estado }}" 
                                    {{ $estado == $consulta->estado ? 'selected' : '' }}>
                                    {{ $estado }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Botón de configuración -->
                        <button wire:click="openModalConfig({{ $consulta->id }})"
                            class="cursor-pointer absolute top-2 right-2 z-10 p-1 bg-white bg-opacity-20 rounded-full 
                                hover:bg-opacity-40 transition-all duration-200 focus:outline-none">
                            <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
                            </svg>


                        </button>

                        <div class="relative ">
                            @foreach ($mascotas as $mascota)
                                @if ($mascota->id == $consulta->mascota_id)
                                    <img class="rounded-t-lg w-full h-48 object-cover"
                                        src="{{ asset("uploads/mascotas/$mascota->foto") }}" alt="Grisho" />
                                @endif
                            @endforeach
                            <div class="absolute bottom-0 left-0 p-2 bg-gray-900/50 text-white text-xs rounded-br-lg">
                                {{ $consulta->mascota->especieN->nombre }} | {{ $consulta->mascota->raza }} |
                                {{ App\Helpers\Helper::edad($consulta->mascota->nacimiento) }} años
                            </div>
                        </div>
                        <div class="p-4 flex flex-col gap-2">
                            <div class="flex justify-between items-center">
                                <h2 class="text-lg font-semibold">{{ $consulta->mascota->nombre }} <span
                                        class="text-xs text-gray-600 font-normal">|
                                        {{ $consulta->mascota->genero }}</span></h2>
                                <span class="text-xs text-gray-500 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $consulta->mascota->dueno->nombre }}
                                </span>
                            </div>
                            {{-- <div class="flex gap-4 text-gray-600 text-sm">
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
                                    <span>Registro:
                                        {{ App\Helpers\Helper::formatearFecha($consulta->mascota->created_at) }}</span>
                                </div>
                            </div> --}}
                            <div class="flex justify-end">
                                <a href="#" class="text-blue-500 text-sm hover:underline">Ver historial
                                    completo</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </main>

    @if ($addConsulta)
        @include('includes.consultas.modalAdd')
    @endif

    @if ($modalConfig)
        @include('includes.consultas.modalConfig')
    @endif

    @if ($tipoConsulta)
        @include('includes.consultas.modalTipoConsulta')
    @endif


    <script>
        function cambiarColor(select) {
            let colores = @json($estados); // Pasamos los colores de Blade a JavaScript
            select.className = "estado-select absolute top-2 left-2 z-10 px-3 py-1 rounded-full text-xs text-white " +
                (colores[select.value] || "bg-gray-300");
        }
    </script>

</div>
