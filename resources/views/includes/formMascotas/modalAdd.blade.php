<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0 z-40 flex justify-center items-center w-full h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md">

        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="closeModalAdd">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <form action="{{ route('mascota.crear') }}" method="POST" enctype="multipart/form-data"
            class="bg-white border border-gray-100 p-8 max-w-md mx-auto shadow-lg rounded-lg max-h-[620px] outline-none overflow-x-hidden overflow-y-auto">
            @csrf
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Agregar Mascota</p>


            <!--  Campo para relacionar don una persona -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Seleccionar Dueño</label>
                <select wire:model='dueno_id' name="dueno_id" name="" id="select2"
                    class="select2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">-Elegir-</option>
                    @foreach ($duenos as $dueno)
                        <option value="{{ $dueno->id }}">{{ $dueno->nombre }} | {{ $dueno->email }}</option>
                    @endforeach
                </select>
                <p>
                    @error('nombre')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <!-- Campo Nombre -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Nombre</label>
                <input wire:model="nombre" name="nombre" type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                    id="nombre">
                <p>
                    @error('nombre')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <!-- Campo Especie -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Especie</label>
                <select wire:model='dueno_id' name="dueno_id" name="" id="select2"
                    class="select2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">-Elegir-</option>
                    @foreach ($duenos as $dueno)
                        <option value="{{ $dueno->id }}">{{ $dueno->nombre }} | {{ $dueno->email }}</option>
                    @endforeach
                </select>                
                <p>
                    @error('telefono')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <!-- Campo genero -->
            <div class="mb-6">
                <label for="especie" class="block text-gray-800 font-medium mb-2">Genero</label>
                <select wire:model='genero' name="genero" id="select2"
                    class="select2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">-Elegir-</option>
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                </select>
                <p>
                    @error('email')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>


            <!-- RAZA -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Raza</label>
                <input wire:model='raza' name="raza" type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                <p>
                    @error('telefono')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <!-- historial medico -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Historial Medico</label>
                <textarea wire:model='historial_medico' name="historial_medico" type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"></textarea>
                <p>
                    @error('telefono')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <!-- nacimiento -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Nacimiento</label>
                <input wire:modal='nacimiento' name="nacimiento" type="date"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                <p>
                    @error('telefono')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Subir Foto</label>
                <input wire:model='foto' type="file" name="foto" id=""
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                <p>
                    @error('telefono')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>
            <!-- Botón Guardar -->
            <button type="submit"
                class="w-full bg-gray-800 text-white font-medium py-2 rounded-md hover:bg-black transition duration-300">
                Guardar
            </button>
        </form>
    </div>
</div>
