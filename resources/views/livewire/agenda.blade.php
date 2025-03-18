<div>
    <div>
        @include('includes.sidebar-add-dueno')
    </div>
    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        <p class="pl-1 py-7 text-4xl font-semibold">Agenda</p>
        <div>
            <div class="bg-white rounded-lg p-4 shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <button wire:click="cambiarMes(-1)"
                        class="cursor-pointer bg-gray-300 px-4 py-2 rounded flex justify-between">
                        <span>
                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                            </svg>
                        </span>
                        Anterior
                    </button>
                    <h2 class="text-xl font-semibold flex justify-between">
                        {{ \Carbon\Carbon::create($anio, $mes)->translatedFormat('F Y') }}
                        <div class="">
                            <button wire:click=""
                                class="ml-3 bg-gray-200 cursor-pointer rounded-full hover:bg-opacity-40 transition-all duration-200 focus:outline-none">
                                <svg class="w-6 h-6 text-gray-600 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
                                </svg>                                
                            </button>                            
                        </div>
                    </h2>

                    <button wire:click="cambiarMes(1)"
                        class="cursor-pointer bg-gray-300 px-4 py-2 rounded flex justify-between">
                        Siguiente
                        <span>
                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>
                        </span>
                    </button>
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
                        @foreach ($dias as $fila)
                            <tr class="border-t border-gray-200">
                                @foreach ($fila as $dia)
                                    <td class="h-24 border border-gray-300 p-2 align-top">
                                        @if ($dia)
                                            <div class="font-bold">{{ $dia['dia'] }}</div>
                                            @foreach ($dia['eventos'] as $evento)
                                                <div
                                                    class="cursor-pointer text-sm bg-blue-200 p-1 mt-1 relative group overflow-hidden transition-all duration-300 h-7 hover:h-20 w-full rounded-lg">
                                                    <div
                                                        class="flex text-center object-center items-center justify-center">
                                                        <p class="mr-1 font-semibold">
                                                            {{ $evento->consulta->mascota->nombre }}</p>
                                                        <img class="ml-1 group-hover:block text-xs text-center h-5 w-5 rounded-full"
                                                            src="{{ asset('uploads/mascotas/' . $evento->consulta->mascota->foto) }}"
                                                            alt="">
                                                    </div>
                                                    <p class="hidden group-hover:block mt-2 text-xs text-center">
                                                        {{ $evento->titulo }}</p>
                                                    <p class="hidden group-hover:block mt-2 text-xs text-center">
                                                        {{ $evento->consulta->hora }}</p>
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
