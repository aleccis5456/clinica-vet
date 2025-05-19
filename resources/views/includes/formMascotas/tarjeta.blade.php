<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0  z-40 flex justify-center items-center w-full h-full bg-black/50 outline-none overflow-x-hidden overflow-y-auto">
    <div class="relative p-4 w-lg md:w-5xl ">

        <div class="flex justify-between">
            @include('includes.formMascotas.botones-sup-tarjeta')
        </div>

        <div class="bg-gray-200 border border-gray-200 rounded-lg shadow-lg  max-w-5xl  h-auto">
            <div class="flex p-2 gap-2 justify-between">
                <div
                    class="bg-white w-full max-w-sm border border-gray-200 rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <!-- foto y nombre de la mascota -->
                    <div class="relative h-66 overflow-hidden">
                        <img class="w-full h-full object-cover transform transition-transform duration-500 hover:scale-110"
                            src="{{ asset("uploads/mascotas/$mascotaT->foto") }}" alt="Foto de {{ $mascotaT->nombre }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <h2 class="absolute bottom-4 left-4 text-white text-2xl font-bold">{{ $mascotaT->nombre }}</h2>
                    </div>

                    <!-- Información de la mascota -->
                    <div class="p-5">
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="bg-gray-50 p-2 rounded-lg">
                                <p class="text-sm text-gray-500">Especie</p>
                                <p class="font-medium">{{ $mascotaT->especieN->nombre }}</p>
                            </div>
                            <div class="bg-gray-50 p-2 rounded-lg">
                                <p class="text-sm text-gray-500">Raza</p>
                                <p class="font-medium">{{ $mascotaT->raza }}</p>
                            </div>
                            <div class="bg-gray-50 p-2 rounded-lg">
                                <p class="text-sm text-gray-500">Sexo</p>
                                <p class="font-medium">{{ $mascotaT->genero }}</p>
                            </div>
                            <div class="bg-gray-50 p-2 rounded-lg">
                                <p class="text-sm text-gray-500">Nacimiento</p>
                                <p class="font-medium">
                                    {{ App\Helpers\Helper::formatearFecha($mascotaT->nacimiento) }}</p>
                            </div>
                        </div>

                        <!-- Información del dueño -->
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Datos del Dueño
                            </h3>
                            <div class="space-y-2">
                                <div class="flex items-center bg-blue-50 p-2 rounded-lg">
                                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    <span class="text-gray-700">{{ $mascotaT->dueno->nombre }}</span>
                                </div>
                                <div class="flex items-center bg-blue-50 p-2 rounded-lg">
                                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    <span class="text-gray-700">{{ $mascotaT->dueno->telefono }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-2 w-2/3 rounded-xl">
                    <div class="bg-white mt-7 rounded-lg shadow-lg min-h-[68%] max-h-[68%] overflow-y-scroll">
                        <table class="min-w-full divide-y divide-gray-200 rounded-xl">
                            <thead class="bg-gray-100 rounded-xl">
                                <tr>
                                    <th
                                        class="px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Fecha</th>
                                    <th
                                        class="px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Vacuna Aplicada</th>
                                    <th
                                        class="px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase tracking-wider ">
                                        Veterinario</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $contador = 0;@endphp
                                @forelse($vacunas as $vacuna)
                                    @if ($vacuna->aplicada == false) @continue @endif
                                    @php $contador++;@endphp
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            {{ App\Helpers\Helper::formatearFecha($vacuna->fecha_vacunacion) }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap flex flex-col items-center">
                                            @include('includes.formMascotas.tarjeta-vacuna-aplicada', [
                                                'vacuna' => $vacuna,
                                            ])

                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-2 text-center text-gray-500">
                                            No hay registros de vacunas.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                    <div class=" mt-4 flex gap-2">
                        <!-- Agendar proxima vacuna -->
                        <div
                            class="{{ $vacuna != null ? 'w-1/2' : 'w-full' }} bg-white rounded-lg shadow-md px-4 py-2 items-center justify-center text-center">
                            <p class="text-center font-semibold text-gray-700 mt-2 mb-2">Agendar proxima vacuna</p>
                            <button wire:click='agendarVacunaTrue'
                                class="p-2 m-2 cursor-pointer transition-all duration-200 hover:bg-gray-300 rounded-lg hover:-translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Agregar notas -->
                        @if ($vacuna != null)
                            <div
                                class="w-1/2 bg-white rounded-lg shadow-sm px-2 py-2 items-center justify-center text-center">
                                @if ($vacuna->notas != '')
                                    <div class="w-full h-full">
                                        <form wire:submit.prevent="updateNota({{ $vacuna->id }})" class="w-full">
                                            <div>
                                                <textarea wire:model='notaEdit' id="nota" rows="4"
                                                    class="rounded-none p-2.5 w-full h-[60px] text-sm text-gray-900 bg-gray-50  border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                            </div>
                                            <button type="submit"
                                                class="cursor-pointer flex justify-end bg-gray-800 hover:bg-gray-700 text-white font-bold py-0.5 px-1 rounded mt-1 text-sm">
                                                Guardar
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <p class="text-center  font-semibold text-gray-700 mt-2 mb-2">Agregar Nota</p>
                                    <button wire:click="addNotaTrue"
                                        class="p-2 m-2 cursor-pointer transition-all duration-200 hover:bg-gray-300 rounded-lg hover:-translate-y-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </button>
                                @endif

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($filtro)
        @include('includes.formMascotas.filtro-tarjeta')
    @endif

    @if ($addNota)
        @include('includes.formMascotas.tarjeta-add-notas')
    @endif

    @if ($agendarVacuna)
        @include('includes.formMascotas.agendar-vacunacion')
    @endif
</div>
