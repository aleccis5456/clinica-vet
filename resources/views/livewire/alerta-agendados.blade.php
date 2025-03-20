<div>
    @if (count($consultas) > 0)
        <div class="bg-red-300/50 border border-red-600 text-red-600 p-4 rounded-lg max-w-md ">
            {{-- <div class="flex items-center space-x-3 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h3 class="text-lg font-semibold">¡Atención!</h3>
            </div> --}}
            <p class="mb-2">Hay consultas agendadas que requieren actualización.</p>
            <p>Mascota(s)</p>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($consultas as $consulta)
                    <li class="text-sm">{{ $consulta->mascota->nombre }} <span class="text-xs">codigo: {{ $consulta->codigo }}</span></li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
