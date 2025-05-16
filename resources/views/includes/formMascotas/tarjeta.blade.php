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
                <div class="bg-white w-1/3 flex flex-col border border-gray-200 rounded-md p-3 shadow-xl">
                    <div class="  mb-4">
                        <img class="mx-auto w-36 h-36 rounded-xl" src="{{ asset("uploads/mascotas/$mascotaT->foto") }}"
                            alt="Foto de {{ $mascotaT->nombre }}">
                        <p> <span class="text-lg font-semibold text-gray-800 mt-2"> Nombre:
                            </span>{{ $mascotaT->nombre }}</p>
                        <p> <span class="text-lg font-semibold text-gray-800 mt-2"> Especie:
                            </span>{{ $mascotaT->especieN->nombre }}</p>
                        <p> <span class="text-lg font-semibold text-gray-800 mt-2"> Raza: </span>{{ $mascotaT->raza }}
                        </p>
                        <p> <span class="text-lg font-semibold text-gray-800 mt-2"> Sexo: </span>{{ $mascotaT->genero }}
                        </p>
                        <p> <span class="text-lg font-semibold text-gray-800 mt-2"> Nacimiento:
                            </span>{{ App\Helpers\Helper::formatearFecha($mascotaT->fechaNacimiento) }}</p>
                    </div>
                    <div class="border-t border-gray-500">
                        <div class="content-center items-center mx-auto mb-4">
                            <p class="text-center mt-4 text-lg font-semibold">Datos del Dueño</p>
                            <p> <span class="text-lg font-semibold text-gray-800 mt-2"> Nombre:
                                </span>{{ $mascotaT->dueno->nombre }}</p>
                            <p> <span class="text-lg font-semibold text-gray-800 mt-2"> Teléfono:
                                </span>{{ $mascotaT->dueno->telefono }}</p>
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
                            {{-- @forelse($mascotaT->vacunas as $vacuna) --}}
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    09/04/2023
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap flex flex-col items-center">
                                    vacuna triple
                                    <div class="max-w-sm">
                                        <form class="max-w-sm" action="">
                                            <input type="file" id="fileInput" class="hidden">
                                            <label for="fileInput" class="cursor-pointer flex">
                                                <div class="bg-gray-200 rounded-md px-2 py-1 mr-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                    </svg>
                                                </div>
                                                <span class="text-xs mt-2">Agregar Etiqueta</span>
                                            </label>

                                        </form>
                                    </div>
                                    <div>
                                        <img src="" alt="">
                                    </div>

                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                </td>
                            </tr>
                            {{-- @empty --}}
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-center text-gray-500">No hay registros de
                                    vacunas.</td>
                            </tr>
                            {{-- @endforelse --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
