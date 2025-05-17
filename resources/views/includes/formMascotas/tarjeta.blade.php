<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0  z-40 flex justify-center items-center w-full h-full bg-black/50 outline-none overflow-x-hidden overflow-y-auto">
    <div class="relative p-4 w-lg md:w-5xl ">

        <button type="button"
            class="cursor-pointer m-2 absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="tarjetaFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <div class="bg-gray-200 border border-gray-200 rounded-lg shadow-lg  max-w-5xl  h-auto">
            <div class="flex p-2 gap-2 justify-between">
                <div
                    class="bg-white w-full max-w-sm border border-gray-200 rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <!-- Imagen con efecto -->
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
                                    {{ App\Helpers\Helper::formatearFecha($mascotaT->fechaNacimiento) }}</p>
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

                <div class="w-2/3 bg-white mt-7 rounded-lg shadow-xl">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
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
                            @forelse($mascotaT->vacunas as $vacuna)
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        {{ App\Helpers\Helper::formatearFecha($vacuna->fecha_vacunacion) }}
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap flex flex-col items-center">
                                        @if ($vacuna->etiqueta == null)
                                            <p class="font-semibold text-sm">{{ $vacuna->producto->nombre }}</p>
                                            <div class="max-w-sm">
                                                <form wire:submit.prevent="guardarEtiqueta({{ $vacuna->id }})"
                                                    class="max-w-sm" enctype="multipart/form-data">
                                                    <input wire:model='etiqueta' type="file" id="fileInput"
                                                        class="hidden">
                                                    @if ($preview && $vacunaId == $vacuna->id)
                                                        <div class="w-36 h-36 relative bg-white m-12">
                                                            <img class="w-auto h-auto object-cover  rounded-md  "
                                                                src="{{ $preview }}" alt="">
                                                            <button
                                                                class=" cursor-pointer absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 hover:bg-gray-100 hover:text-black"
                                                                wire:click="removeImage" type="button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-4 h-4">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                            <button
                                                                class="text-xs text-center mt-4 font-semibold text-gray-100 bg-gray-800 rounded-md px-2 py-1 cursor-pointer hover:bg-gray-700"
                                                                type="submit">Guardar</button>
                                                        </div>
                                                    @else
                                                        <label for="fileInput" class="cursor-pointer flex"
                                                            wire:click="setVacunaId({{ $vacuna->id }})">
                                                            <div class="bg-gray-200 rounded-md px-2 py-1 mr-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                                </svg>
                                                            </div>
                                                            <span
                                                                class="text-xs mt-2 font-semibold text-gray-500">Agregar
                                                                Etiqueta</span>
                                                    @endif
                                                    </label>
                                                </form>
                                            </div>
                                        @else
                                            <div class="relative flex gap-2 items-center">
                                                <p class="text-sm font-semibold text-gray-700">
                                                    {{ $vacuna->producto->nombre }}</p>
                                                <div class="group">
                                                    <img class=" w-12 h-12 transition-all duration-150 group-hover:scale-500 group-hover:mb-26"
                                                        src="{{ asset("uploads/etiquetas/$vacuna->etiqueta") }}"
                                                        alt="">

                                                    <button wire:click="deleteImage({{ $vacuna->id }})"
                                                        type="button"
                                                        class="cursor-pointer opacity-0 transition-ease-in duration-500 group-hover:opacity-100 -z-10 group-hover:z-40 absolute -top-23 -right-22 bg-red-500 text-white rounded-full p-1 hover:bg-gray-100 hover:text-black">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center text-gray-500">No hay registros de
                                        vacunas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
