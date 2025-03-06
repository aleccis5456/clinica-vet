<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0 z-40 flex justify-center items-center w-full h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md">

        <button type="button"
            class="m-2 absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="closeModalConfig">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <!-- FORMULARIO -->
        <form wire:submit.prevent="update"
            class="bg-white border border-gray-100 p-6 min-w-md mx-auto shadow-lg rounded-lg max-h-[620px] outline-none overflow-x-hidden overflow-y-auto">
            <!-- Título -->
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Actualizar Consulta</p>

            <!-- NOTAS -->
            @if ($consultaToEdit->notas != null)
                <div class="p-2 flex w-auto rounded-md bg-blue-100  text-blue-800 shadow-sm">
                    <div class="flex">
                        <svg class="w-6 h-6  " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <p class="pl-0.5 font-semibold ">NOTA: </p> <span
                            class="pl-1">{{ $consultaToEdit->notas }}</span>
                    </div>
                </div>
            @endif

            <div class="shadow-lg rounded-lg p-2 bg-gray-100 mt-3">
                <div class="grid grid-cols-2 rounded-lg gap-4 mt-2 hover:bg-gray-100">
                    <!-- grid de foto -->
                    <div class="">
                        @php
                            $mascota = App\Models\Mascota::find($consultaToEdit->mascota_id);
                        @endphp
                        <img class="w-[200px] aspect-[4/3] object-cover rounded-lg"
                            src="{{ asset("uploads/mascotas/$mascota->foto") }}" alt="">
                    </div>

                    <!-- grid de la info de la consulta -->
                    <div>
                        <p class="text-sm font-bold p-2 h-auto">{{ $mascota->nombre }} <span class="text-gray-600">|
                                {{ $mascota->dueno->nombre }}</span></p>
                        <div class="border-t border-gray-300 mt-2 pt-2 text-sm">
                            <p class="text-gray-700"><b>Historial clínico:</b> {{ $mascota->historial_medico }}</p>
                        </div>
                    </div>
                </div>                
                <!-- Atendido por -->
                <div class="p-2 border-gray-400">                    
                    <div class="p-2">
                        <p class="font-semibold">Atendido por:</p><span>{{ $consulta->veterinario->name }}</span>
                        @if (!$cambiarVet)
                            <span wire:click='openCambiarVet'
                                class="text-xs cursor-pointer m-4 p-1 rounded-lg text-white font-semibold bg-gray-800">cambiar</span>                                
                        @else
                            @if (empty($vetChanged))
                                <span  wire:click='closeCambiarVet'
                                    class="text-xs cursor-pointer m-4 p-1 rounded-lg text-white font-semibold bg-gray-800">cancelar</span>
                            @else
                            <span  wire:click='closeCambiarVet'
                                    class="text-xs cursor-pointer m-4 p-1 rounded-lg text-white font-semibold bg-gray-800">cancelar</span>

                                <button wire:click='closeCambiarVet' 
                                    type="submit"
                                    class="text-xs cursor-pointer p-1 rounded-lg text-white font-semibold bg-gray-800">aceptar</button>
                            @endif
                        @endif
                    </div>

                    @if ($cambiarVet)
                        <div class="mb-5">
                            <label class="block text-gray-800 font-medium mb-2">Seleccionar nuevo veterinario</label>
                            <select name="" id="" wire:model='cambiarVetId' 
                                class="w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                                <option value="">-Seleccionar-</option>
                                @foreach ($veterinarios as $veterinario)
                                    @if ($veterinario->id != $consulta->veterinario_id)
                                        <option wire:click='setVetChanged({{ $veterinario->id }})' value="{{ $veterinario->id }}">
                                            {{ $veterinario->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @endif

                </div>
            </div>

            <!-- CAMBIAR ESTADO -->
            <div class="mb-5 mt-5">
                <label class="block text-gray-800 font-medium mb-2">Cambiar Estado</label>
                <select name="" id=""
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">-Seleccionar-</option>
                    <option value="">En consultorio</option>
                    <option value="">Agendado</option>
                    <option value="">Finalizado</option>
                    <option value="">Pendiente</option>
                    <option value="">Cancelado</option>
                </select>
            </div>

            <!-- Veterinario -->
            <div class="mb-4 mt-5">
                <label class="block text-gray-800 font-medium mb-2">Agregar Veterinario</label>
                @foreach ($veterinarios as $veterinario)
                    @if ($veterinario->id != $consulta->veterinario_id)
                        <input type="checkbox" name="vet_id" id="" value="{{ $veterinario->id }}">
                        {{ $veterinario->name }} <br>
                    @endif
                    {{-- <input type="radio" name="" id="" value="{{ $veterinario->id }}"> {{ $veterinario->name }} <br> --}}
                @endforeach
                @error('veterinario_id')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Fecha</label>
                <input type="date" wire:model="fecha"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('fecha')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tipo -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Tipo de Consulta</label>
                <select wire:model="tipo"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">Selecciona un tipo</option>
                    <option value="Consulta general">Consulta general</option>
                    <option value="Vacunación">Vacunación</option>
                    <option value="Cirugía">Cirugía</option>
                    <option value="Emergencia">Emergencia</option>
                </select>
                @error('tipo')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror
            </div>

            <!-- Síntomas -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Síntomas</label>
                <textarea wire:model="sintomas"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                    rows="3" placeholder="Describe los síntomas"></textarea>
                @error('sintomas')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror
            </div>

            <!-- Diagnóstico -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Diagnóstico</label>
                <textarea wire:model="diagnostico"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                    rows="3" placeholder="Describe el diagnóstico"></textarea>
                @error('diagnostico')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tratamiento -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Tratamiento</label>
                <textarea wire:model="tratamiento"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                    rows="3" placeholder="Describe el tratamiento"></textarea>
                @error('tratamiento')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror
            </div>

            <!-- Notas -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Notas adicionales</label>
                <textarea wire:model="notas"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                    rows="3" placeholder="Añade notas adicionales"></textarea>
                @error('notas')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botón de envío -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-gray-800 text-white font-medium rounded-md hover:bg-gray-700 transition duration-300">
                    Guardar
                </button>
            </div>
        </form>

    </div>
</div>
