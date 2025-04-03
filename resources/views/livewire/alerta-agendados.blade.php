<div>
    @if ($mostrar)
        <div class="bg-red-300/50 border border-red-600 text-red-600 p-4 rounded-lg max-w-md ">            
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
