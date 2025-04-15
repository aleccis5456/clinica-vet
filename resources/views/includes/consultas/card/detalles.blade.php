{{-- {{ $consulta->fecha < now()->format('Y-m-d') ? 'bg-red-500' : ($consulta->hora < now()->format('H:i:s') ? 'bg-red-500' : 'bg-blue-400') }} --}}
<div
    class="group absolute rounded-full top-10 left-2 z-10 cursor-pointer text-sm                                             
        {{ $consulta->fecha > now()->format('Y-m-d') ? 'bg-blue-400' : ($consulta->fecha == now()->format('Y-m-d') && $consulta->fecha > now()->format('H:i:s') ? 'bg-blue-400' :'bg-red-500') }}
        p-1 overflow-hidden transition-all duration-300 w-7 h-7 hover:w-36 hover:h-20 hover:rounded-md">
        
    <div class="flex text-center object-center items-center justify-center">
        <p class="group-hover:hidden">
            <svg class="w-5 h-5 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </p>
    </div>
    <div class="flex">
        <p class="hidden group-hover:block text-xs text-center object-center justify-between">
            <svg class="w-5 h-5 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </p>
        <span class="pl-5 font-semibold">Detalles</span>
    </div>
    <p class="hidden group-hover:block mt-1 text-xs text-center object-center">
        Fecha: {{ \Carbon\Carbon::parse($consulta->fecha)->format('d-m-Y') }}
    </p>
    <p class="hidden group-hover:block mt-1 text-xs text-center object-center">
        Hora: {{ \Carbon\Carbon::parse($consulta->hora)->format('H:i') }}
    </p>
</div>
