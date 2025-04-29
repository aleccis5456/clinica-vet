<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0 z-40 flex justify-center items-center w-full h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md">

        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="editarFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <form action="{{ route('inventario.update', ['productoId' => $productoToEdit->id]) }}" method="POST" enctype="multipart/form-data"            
            class="bg-white border border-gray-100 p-8 max-w-md mx-auto shadow-lg rounded-lg max-h-[620px] outline-none overflow-x-hidden overflow-y-auto">
            @csrf
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Editar Producto: {{ $productoToEdit->nombre }}</p>
        
            <!-- Nombre -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Nombre</label>
                <input name="nombre" type="text" value="{{ $productoToEdit->nombre }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('nombre') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
        
            <!-- Descripción -->
            <div class="mb-4">                
                <label class="block text-gray-800 font-medium mb-2">Descripción</label>
                <textarea name="descripcion"
                    class="w-full h-[150px] px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    {{ $productoToEdit->descripcion }}
                </textarea>
                @error('descripcion') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
        
            <!-- Categoría -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Categoría</label>
                <select name="categoria" id=""
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categorias as $categoria)                        
                        <option value="{{ $categoria->id }}" {{ $categoria->id == $productoToEdit->categoria_id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
        
            <!-- Precio -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Precio</label>
                <input name="precio" type="number" step="0.01" value="{{ $productoToEdit->precio }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('precio') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
        
            <!-- Precio de Compra -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Precio de Compra</label>
                <input value="{{ $productoToEdit->precio_compra }}" name="precio_compra" type="number" step="0.01"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('precio_compra') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
        
            <!-- Stock Actual -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Stock Actual</label>
                <input value="{{$productoToEdit->stock_actual}}" name="stock_actual" type="number"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('stock_actual') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>
        
            <!-- Foto -->
            <div class="mb-4">                
                <label class="block text-gray-800 font-medium mb-2">Foto</label>
                <div class="flex items-center mb-2">
                    <p>foto actual:</p>
                    <img class="w-12 h-12" src="{{ asset("uploads/productos/$productoToEdit->foto") }}" alt="" srcset="">
                    <label class="pl-4 text-sm" for="">Eliminar?</label>
                    <input type="checkbox" name="deleteFoto" >
                </div>                
                <input wire:model="foto" name="foto" type="file"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('foto') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <div class="border-t-4 border-gray-700 my-4 pt-5">
                    <label class="block text-gray-800 font-medium mb-2">Precios para uso interno</label>
                    <div class="flex items-center mb-4 gap-2">
                        <select name="unidades" id="unidades"
                            class="w-1/3 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                            <option value="cu" {{ $productoToEdit->unidad_medida == 'cu' ? 'selected' : '' }}>c/u</option>
                            <option value="ml" {{ $productoToEdit->unidad_medida == 'ml' ? 'selected' : '' }}>ml</option>
                            <option value="mg" {{ $productoToEdit->unidad_medida == 'mg' ? 'selected' : '' }}>mg</option>
                            <option value="gr" {{ $productoToEdit->unidad_medida == 'gr' ? 'selected' : '' }}>gr</option>
                        </select>
    
                        <input value="{{ $productoToEdit->cantidad }}" type="number" name="cantidad" 
                                class="py-2 w-1/4 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                        <input
                            class="py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100"
                            type="number" name="precio_interno" value="{{ $productoToEdit->precio_interno }}">
                    </div>
                </div>
    
            </div>
        
            <!-- Botón de enviar -->
            <button type="submit"
                class="w-full bg-gray-800 text-white font-medium py-2 rounded-md hover:bg-black transition duration-300">
                Guardar Producto
            </button>
        </form>
    </div>
</div>