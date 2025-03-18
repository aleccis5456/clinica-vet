<div>
    <div>
        @include('includes.sidebar-add-dueno')
    </div>
    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        <p class="pl-1 py-7 text-4xl font-semibold">Agenda</p>
        <div>
            <div class="bg-white rounded-lg p-4 shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <button wire:click="cambiarMes(-1)" class="bg-gray-300 px-4 py-2 rounded"><- Anterior</button>
                    <h2 class="text-xl font-semibold">{{ \Carbon\Carbon::create($anio, $mes)->translatedFormat('F Y') }}</h2>
                    <button wire:click="cambiarMes(1)" class="bg-gray-300 px-4 py-2 rounded">Siguiente -></button>
                </div>
            
                <table class="min-w-full bg-white rounded-lg">
                    <thead class="bg-gray-200 text-gray-800">
                        <tr>
                            <th class="py-3 px-4 text-center">Lunes</th>
                            <th class="py-3 px-4 text-center">Martes</th>
                            <th class="py-3 px-4 text-center">Miércoles</th>
                            <th class="py-3 px-4 text-center">Jueves</th>
                            <th class="py-3 px-4 text-center">Viernes</th>
                            <th class="py-3 px-4 text-center">Sábado</th>
                            <th class="py-3 px-4 text-center">Domingo</th>
                        </tr>
                    </thead>
            
                    <tbody class="text-gray-800">
                        @foreach($dias as $fila)
                            <tr class="border-t border-gray-200">
                                @foreach($fila as $dia)
                                    <td class="h-24 border border-gray-300 p-2 align-top">
                                        @if($dia)
                                            <div class="font-bold">{{ $dia['dia'] }}</div>
                                            @foreach($dia['eventos'] as $evento)
                                                <div class="text-sm bg-blue-200 p-1 rounded mt-1">
                                                    <p>{{ $evento->consulta->mascota->nombre }}</p>
                                                    <p>{{ $evento->titulo }}</p>                                                    
                                                    <p>{{ $evento->consulta->hora }}</p>
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </main>
</div>
