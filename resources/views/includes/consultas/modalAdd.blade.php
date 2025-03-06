<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0 z-40 flex justify-center items-center w-full h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md">

        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="closeAddConsulta">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>
        <form wire:submit.prevent="crearConsulta"
            class="bg-white border border-gray-100 p-8 max-w-md mx-auto shadow-lg rounded-lg max-h-[620px] outline-none overflow-x-hidden overflow-y-auto">            
            <!-- Título -->
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Agregar Consulta</p>

            <!-- Mascota -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Mascota</label>
                <select wire:model="mascota_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">Selecciona una mascota</option>
                    @foreach ($mascotas as $mascota)
                        <option value="{{ $mascota->id }}">{{ $mascota->nombre }} | {{ $mascota->dueno->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('mascota_id')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror
            </div>

            <!-- Veterinario -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Veterinario</label>
                <select wire:model="veterinario_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">Selecciona un veterinario</option>
                    <optgroup label="Doctores">
                        @foreach ($veterinarios as $veterinario)
                            <option value="{{ $veterinario->id }}">{{ $veterinario->name }}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Estetica">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </optgroup>                    
                </select>
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
                    <option value="Consulta general">Estetica (Baño y peluqueria)</option>
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
