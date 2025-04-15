<div class="py-10 grid grid-cols-2 md:grid-cols-4 gap-4">
    @foreach ($consultas as $consulta)

        <div class="max-w-[270px] shadow-md rounded-lg overflow-hidden transition-all duration-200 hover:scale-101 hover:shadow-lg relative 
            border {{ $estadosf[$consulta->estado] ?? 'bg-gray-200 border-gray-300' }}"
            id="consulta-{{ $consulta->id }}">
            <!-- Tag de estado con degradado -->
            <select name="" id="" wire:change='updateEstado({{ $consulta->id }}, $event.target.value)'
                class="cursor-pointer estado-select absolute top-2 left-2 z-10 px-2 py-0.5 text-xs font-semibold text-black rounded-lg
                                    bg-gradient-to-r {{ $estados[$consulta->estado] ?? 'from-gray-300 to-gray-400 hover:from-gray-400 hover:to-gray-500' }}"
                onchange="cambiarColor(this)">
                @foreach ($estados as $estado => $color)
                    <option value="{{ $estado }}" {{ $estado == $consulta->estado ? 'selected' : '' }}>
                        {{ $estado }}
                    </option>
                @endforeach
            </select>

            <!-- detalles de consulta agendado -->
            @if ($consulta->estado == 'Agendado')
                @include('includes.consultas.card.detalles')
            @endif
            
            <div class="flex flex-col">
                <!-- Botón de actualizacion -->
                <div class="group">
                    <button wire:click="openModalConfig({{ $consulta->id }})"
                        class=" bg-gray-200 cursor-pointer absolute top-2 right-2 z-10 p-1  rounded-full 
                                            hover:bg-opacity-40 transition-all duration-200 focus:outline-none">
                        <svg class="w-6 h-6 text-gray-600 transition duration-300 group-hover:rotate-45 group-hover:text-gray-800"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
                        </svg>
                    </button>
                </div>

                <!-- icono para enviar a caja-->
                <div>                
                    @include('includes.consultas.card.crear-caja')
                </div>
                <!-- end envió a caja -->
            </div>

            <!-- foto de la mascota-->
            <div class="relative ">
                @foreach ($mascotas as $mascota)
                    @if ($mascota->id == $consulta->mascota_id)
                        <img class="rounded-t-lg w-full h-48 object-cover"
                            src="{{ asset("uploads/mascotas/$mascota->foto") }}" alt="Nombre" />
                    @endif
                @endforeach
                <div class="absolute bottom-0 left-0 p-2 bg-gray-900/50 text-white text-xs rounded-br-lg">
                    {{ $consulta->mascota->especieN->nombre }} | {{ $consulta->mascota->raza }} |
                    {{ App\Helpers\Helper::edad($consulta->mascota->nacimiento) }} años
                </div>
            </div>
            <!-- información de la mascota y de la consulta -->
            @include('includes.consultas.card.informacion-consulta-macota')
        </div>
    @endforeach
</div>


