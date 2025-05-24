<div>
    <div
        class="group absolute rounded-full top-10 left-2 z-20 cursor-pointer text-sm                                             
        {{ $consulta->fecha > now()->format('Y-m-d') ? 'bg-blue-400' : ($consulta->fecha == now()->format('Y-m-d') && $consulta->fecha > now()->format('H:i:s') ? 'bg-blue-400' : 'bg-red-200 text-red-600') }}
        p-1 overflow-hidden transition-all duration-300 w-7 h-7 hover:w-36 hover:h-20 hover:rounded-md">

        <div class="flex text-center object-center items-center justify-center">
            <p class="group-hover:hidden">
                <svg class="w-5 h-5 text-red-600 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </p>
        </div>
        <div class="flex">
            <p class="hidden group-hover:block text-xs text-center object-center justify-between">
                <svg class="w-5 h-5 text-red-600 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </p>
            <span class="pl-1 text-sm font-semibold">Agendado para:</span>
        </div>
        <p class="hidden group-hover:block mt-1 text-xs text-center object-center">
            Fecha: {{ \Carbon\Carbon::parse($consulta->fecha)->format('d-m-Y') }}
        </p>
        <p class="hidden group-hover:block mt-1 text-xs text-center object-center">
            Hora: {{ \Carbon\Carbon::parse($consulta->hora)->format('H:i') }}
        </p>
    </div>

    @if ($consulta->estado == 'Agendado' && $consulta->fecha <= now()->format('Y-m-d'))
        <div wire:click="enviarRecordatorio({{ $consulta->id }})" 
            class="group">
            <div class=" absolute rounded-full top-20 left-2 z-10 cursor-pointer text-sm bg-green-200          
                p-1 overflow-hidden transition-all duration-300 w-7 h-7">
                <div
                    class="flex text-center object-center items-center justify-center transition-all duration-300 group-hover:translate-x-0.5">
                    <svg class="w-5 h-5 text-green-700 " xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                </div>
            </div>
            <i  class="transition-all duration-200 ease-in opacity-0 group-hover:opacity-100  group-hover:z-20 absolute top-16 left-9 -z-20 bg-green-200 text-green-700 font-semibold text-xs  px-2 py-1 rounded-md">
                Enviar Recordatorio
            </i>
        </div>
    @endif
</div>
