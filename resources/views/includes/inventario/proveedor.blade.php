<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0 z-40 flex justify-center items-center w-full h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md">

        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="proveedorFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <form wire:submit.prevent='crearProveedor'
            class="bg-white border border-gray-100 p-8 max-w-md mx-auto shadow-lg rounded-lg max-h-[620px] outline-none overflow-x-hidden overflow-y-auto">
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Agregar Proveedor</p>

            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Nombre</label>
                <input wire:model='nombreP' type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('nombreP')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Ruc</label>
                <input wire:model='ruc' type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('nombreP')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Teléfono</label>
                <input wire:model='telefonoP' type="number"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('nombreP')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">email</label>
                <input wire:model='email' type="string"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('nombreP')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-gray-800 text-white font-medium py-2 rounded-md hover:bg-black transition duration-300">
                Guardar Proveedor
            </button>
        </form>
    </div>
</div>
