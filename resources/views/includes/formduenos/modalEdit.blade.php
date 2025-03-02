<div class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-[9999]">
    <div class="bg-white rounded-2xl p-8 space-y-6 max-w-md w-full relative">
        <!-- Botón de cierre -->
        <button wire:click="closeModalEdit" class="cursor-pointer absolute top-3 right-3 hover:bg-gray-200 hover:rounded-full">
            <svg class="w-6 h-6 text-gray-800 hover:text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
              </svg>                      
        </button>

        <h3 class="text-2xl font-bold text-center text-gray-800">Editar a: {{ $duenoToEdit->nombre }}</h3>
        
        <div class="grid grid-cols-1">
            <form wire:submit='editSave' class=" p-6 max-w-md mx-auto">                                             
                <input type="hidden" wire:model="duenoId" value="{{ $dueno->id }}">
                <!-- Campo Nombre y Apellido -->
                <div class="mb-4">
                    <label class="block text-gray-800 font-medium mb-2">Nombre y Apellido Actual: {{ $duenoToEdit->nombre }}</label>
                    <input wire:model="nombre" type="text"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"                        
                        id="nombre" placeholder="Ingrese el nuevo nombre">
                    <p>
                        @error('nombre')
                            <span class="text-red-700 underline">{{ $message }}</span>
                        @enderror
                    </p>
                </div>
            
                <!-- Campo Número de Teléfono -->
                <div class="mb-4">
                    <label class="block text-gray-800 font-medium mb-2">Número de Teléfono Actual: {{ $duenoToEdit->telefono }}</label>
                    <input wire:model='telefono' type="number"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                        placeholder="Ingrese el nuevo numero">
                    <p>
                        @error('telefono')
                            <span class="text-red-700 underline">{{ $message }}</span>
                        @enderror
                    </p>
                </div>
            
                <!-- Campo Correo Electrónico -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-800 font-medium mb-2">Correo Electrónico Actual: {{ $duenoToEdit->email }}</label>
                    <input wire:model='email' type="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                        placeholder="Ingrese el nuevo correo"
                        id="email">
                    <p>
                        @error('email')
                            <span class="text-red-700 underline">{{ $message }}</span>
                        @enderror
                    </p>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-800 font-medium mb-2">Mascotas</label>                    
                    <select name="" id="" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                        <option value="">-Ver Mascotas-</option>
                        <option value="">
                            @foreach ($dueno->mascotas as $mascota)
                                {{ $mascota->nombre }}
                            @endforeach                            
                        </option>
                    </select>
                </div>
            

                <!-- Botón Guardar -->
                <button type="submit"
                    class="w-full bg-gray-800 text-white font-medium py-2 rounded-md hover:bg-black transition duration-300">
                    Aceptar
                </button>
            </form>
            
        </div>
    </div>
</div>    