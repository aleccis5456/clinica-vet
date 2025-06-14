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
            class="bg-white border border-gray-100 p-8 max-w-md mx-auto shadow-lg rounded-lg max-h-screen outline-none overflow-x-hidden overflow-y-auto"
            onkeydown="return event.key !== 'Enter';">
            <!-- Título -->
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Agregar Consulta</p>

            <!-- Mascota -->
            <div class="mb-4 relative">
                <label class="block text-gray-800 font-medium mb-2">Mascota</label>
                <input type="text" wire:model='mascotaSearch' wire:keydown.enter='mascotasBusquedaTrue'
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                <button type="submit" 
                        class="absolute right-1 mt-[3px] bg-gray-200 hover:bg-gray-300 transition p-2 rounded-lg">
                    <svg class="w-5 h-5 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 21 21">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </button>
                
                @error('mascota_id')
                    <span class="rounded-lg px-2 py-1 text-red-700 font-semibold text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tipo -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Tipo de Consulta</label>
                <div class="flex gap-2">                                    
                    <select wire:model="tipo"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                        <option value="">Selecciona un tipo</option>
                        @foreach ($tipoConsultas as $tipoConsulta)
                            <option value="{{ $tipoConsulta->id }}">{{ $tipoConsulta->nombre }} 
                                 {{ $tipoConsulta->precio > 0 ? " - ". App\Helpers\Helper::formatearMonto($tipoConsulta->precio) . " Gs." : ''}}</option>
                        @endforeach
                    </select>
                    <button wire:click='openTipoConsulta'
                            type="button"
                            class="bg-gray-800 px-3 py-1 rounded-lg cursor-pointer text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                </div>
                @error('tipo')
                    <span class="rounded-lg px-2 py-1 text-red-700 font-semibold text-sm">{{ $message }}</span>
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
                    <span class="rounded-lg px-2 py-1 text-red-700 font-semibold text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Fecha</label>
                <input type="date" wire:model="fecha"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('fecha')
                    <span class="rounded-lg px-2 py-1 text-red-700 font-semibold text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- hora-->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Hora</label>
                <input type="time" wire:model="hora"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('fecha')
                    <span class="rounded-lg px-2 py-1 text-red-700 font-semibold text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Síntomas -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Síntomas</label>
                <textarea wire:model="sintomas"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                    rows="3" placeholder="Describe los síntomas"></textarea>
                @error('sintomas')
                    <span class="rounded-lg px-2 py-1 text-red-700 font-semibold text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Diagnóstico -->
            {{-- <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Diagnóstico</label>
                <textarea wire:model="diagnostico"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                    rows="3" placeholder="Describe el diagnóstico"></textarea>
                @error('diagnostico')
                    <span class="rounded-lg px-2 py-1 text-red-700 font-semibold text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tratamiento -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Tratamiento</label>
                <textarea wire:model="tratamiento"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                    rows="3" placeholder="Describe el tratamiento"></textarea>
                @error('tratamiento')
                    <span class="rounded-lg px-2 py-1 text-red-700 font-semibold text-sm">{{ $message }}</span>
                @enderror
            </div> --}}

            <!-- Notas -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Notas adicionales</label>
                <textarea wire:model="notas"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                    rows="3" placeholder="Añade notas adicionales"></textarea>
                @error('notas')
                    <span class="rounded-lg px-2 py-1 text-red-700 font-semibold text-sm">{{ $message }}</span>
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
