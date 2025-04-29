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

    <!-- TIPO DE CONSULTA -->
    <div class="gap-4 text-gray-600 text-sm">
        <div class="flex items-center gap-2">
            <!-- Icono -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-clipboard" viewBox="0 0 16 16">
                <path
                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                <path
                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
            </svg>
            <!-- Texto -->
            <p class="font-semibold text-gray-700">
                {{ Str::upper($consulta->tipoConsulta->nombre) }}</p>
        </div>
    </div>
    <!-- HISTOTIAL COMPLETO -->
    <div class="flex justify-center">
        <a wire:navigate href="{{ route('historial.completo', ['id' => $consulta->mascota->id]) }}"
            class="flex items-center gap-5 text-xs md:text-sm font-semibold px-4 py-2 
                                bg-gradient-to-r from-blue-400 to-blue-500 
                                hover:from-blue-600 hover:to-blue-700 
                                text-white rounded-lg ">
            <span>Historial completo</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </a>
    </div>
    <p class="text-xs text-gray-500">Código: {{ $consulta->codigo }}</p>
</div>