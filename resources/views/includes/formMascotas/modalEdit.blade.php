<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/50">
    <div class="bg-white rounded-2xl relative p-4 w-full max-w-md max-h-[620px] overflow-x-hidden overflow-y-auto">
        <button wire:click="closeModalEdit"
            class="cursor-pointer absolute top-3 right-3 hover:bg-gray-200 hover:rounded-full">
            <svg class="w-6 h-6 text-gray-800 hover:text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18 17.94 6M18 18 6.06 6" />
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-center text-gray-800">Editar a: {{ $mascotaToEdit->nombre }}</h3>


        <form action="{{ route('mascota.editsave') }}" method="POST" enctype="multipart/form-data"
             class=" p-6 max-w-md mx-auto outline-none ">
            @csrf
            <input type="hidden" name="mascotaId" value="{{ $mascotaToEdit->id }}">
            <!-- Campo Nombre y Apellido -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Humano Actual: {{ $mascotaToEdit->dueno->nombre }}</label>
                <select wire:model='dueno_id' name="dueno_id"
                    class="select2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">-Cambiar Humano-</option>
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
                <label class="block text-gray-800 font-medium mb-2">Nombre Actual: {{ $mascotaToEdit->nombre }}</label>
                <input wire:model="nombre" name="nombre" type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                    id="nombre" placeholder="Ingrese el nuevo nombre...">
                <p>
                    @error('nombre')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <!-- Campo Especie -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Especie Actual: {{ $mascotaToEdit->especieN->nombre }}</label>
                <select  name="especie_id" id="select2"
                    class="select2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">-Cambiar Especie-</option>
                    @foreach ($especies as $especie)
                        <option value="{{ $especie->id }}">{{ $especie->nombre }}</option>
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
                <label for="genero" class="block text-gray-800 font-medium mb-2">Genero Actual: {{ $mascotaToEdit->genero }}</label>
                <select wire:model='genero' name="genero" id="select2"
                    class="select2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">-Cambiar Genero-</option>
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
                <label class="block text-gray-800 font-medium mb-2">Raza Actual: {{ $mascotaToEdit->raza }}</label>
                <input wire:model='raza' 
                    name="raza" type="text"
                    placeholder="Ingrese la nueva raza..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                <p>
                    @error('telefono')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <!-- historial medico -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Historial Medico Actual: <br>
                    @if (is_null($mascotaToEdit->historial_medico))
                        <p class="text-xs">Sin Historial</p>
                    @else
                        <input disabled class="text-xs font-normal" type="text" value="{{ $mascotaToEdit->historial_medico }}">                    
                        <span class="text-xs">Eliminar?:</span>
                        <input value="true" type="checkbox" name="flagEliminarHM" id="">
                    @endif                    
                </label>
                <textarea wire:model='historial_medico'                             
                            name="historial_medico" type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    {{ $mascotaToEdit->historial_medico }}
                </textarea>
                <p>
                    @error('telefono')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <!-- nacimiento -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Nacimiento Actual: {{ App\Helpers\Helper::formatearFecha($mascotaToEdit->nacimiento) }}</label>
                <input wire:model='nacimiento'
                    name="nacimiento" type="date"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                <p>
                    @error('telefono')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Foto Actual:                    
                    <div class="flex items-center space-x-2 text-xs">
                        <img class="w-12 h-12 rounded-full mb-2" src="{{ asset("uploads/mascotas/$mascotaToEdit->foto") }}" alt="" srcset="">
                        <span>Eliminar?:</span>                                                
                        <input value="true" type="checkbox" name="flagElimiarFoto" id="">
                    </div>
                    Elegir Foto:                            
                </label>                
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
                Aceptar
            </button>
        </form>
    </div>
</div>
