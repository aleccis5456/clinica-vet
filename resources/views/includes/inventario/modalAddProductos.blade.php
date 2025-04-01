<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0 z-40 flex justify-center items-center w-full h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md">

        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="closeModalAgregar">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <form action="{{ route('inventario.store') }}" method="POST" enctype="multipart/form-data"            
            class="bg-white border border-gray-100 p-8 max-w-md mx-auto shadow-lg rounded-lg max-h-[620px] outline-none overflow-x-hidden overflow-y-auto">
            @csrf
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Agregar Producto</p>
        
            <!-- Nombre -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Nombre</label>
                <input name="nombre" type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('nombre') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
            
            <!-- Codigo -->
            <div class="mb-4">
                <div class="flex">
                    <label class="mr-2 block text-gray-800 font-medium mb-2">Código</label>
                    <input class="mb-2 mr-1 cursor-pointer" type="checkbox" name="flagCodigo" id=""><p class="text-xs mt-1">Código Automático</p>
                </div>                
                <input name="codigo" type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('nombre') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Descripción</label>
                <textarea name="descripcion"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"></textarea>
                @error('descripcion') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
        
            <!-- Categoría -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Categoría</label>
                <select name="categoria_id" id=""
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>

            <!-- Proveedor -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Proveedor</label>
                <select name="proveedor_id" id=""
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">Seleccione un proveedor</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
        
            <!-- Precio -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Precio</label>
                <input wire:model="precio" name="precio" type="number" step="0.01"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('precio') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
        
            <!-- Precio de Compra -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Precio de Compra</label>
                <input wire:model="precio_compra" name="precio_compra" type="number" step="0.01"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('precio_compra') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
        
            <!-- Stock Actual -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Stock Actual</label>
                <input wire:model="stock_actual" name="stock_actual" type="number"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('stock_actual') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
        
            <!-- Foto -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Foto</label>
                <input wire:model="foto" name="foto" type="file"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('foto') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
        
            <!-- Botón de enviar -->
            <button type="submit"
                class="w-full bg-gray-800 text-white font-medium py-2 rounded-md hover:bg-black transition duration-300">
                Guardar Producto
            </button>
        </form>
        
    </div>
</div>