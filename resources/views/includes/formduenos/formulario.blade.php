<form wire:submit='crearDueno' class="bg-white p-6 max-w-md mx-auto">
    <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Agregar Dueño</p>

    <!-- Campo Nombre y Apellido -->
    <div class="mb-4">
        <labelclass="block text-gray-800 font-medium mb-2">Nombre y Apellido</label>
        <input wire:model="nombre" type="text"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
            id="nombre">
        <p>
            @error('nombre')
                <span class="text-red-700 underline">{{ $message }}</span>
            @enderror
        </p>
    </div>

    <!-- Campo Número de Teléfono -->
    <div class="mb-4">
        <label class="block text-gray-800 font-medium mb-2">Número de Teléfono</label>
        <input wire:model='telefono' type="number"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
        <p>
            @error('telefono')
                <span class="text-red-700 underline">{{ $message }}</span>
            @enderror
        </p>
    </div>

    <!-- Campo Correo Electrónico -->
    <div class="mb-6">
        <label for="email" class="block text-gray-800 font-medium mb-2">Correo Electrónico</label>
        <input wire:model='email' type="email"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
            id="email">
        <p>
            @error('email')
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