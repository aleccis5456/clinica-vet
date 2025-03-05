<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0 z-40 flex justify-center items-center w-full h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md">

        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="closeModalCategoria">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <form wire:submit.prevent='agregarCategoria'
        class="bg-white border border-gray-100 p-8 max-w-md mx-auto shadow-lg  {{ $tableCategoria == true ? 'rounded-t-lg' : 'rounded-lg' }} max-h-[620px] outline-none overflow-x-hidden overflow-y-auto">
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Agregar Categoria</p>
        
            <!-- Nombre -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Nombre</label>
                <input wire:model="categoria" name="nombre" type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                @error('nombre') <span class="text-red-700 underline">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                class="w-full bg-gray-800 text-white font-medium py-2 rounded-md hover:bg-black transition duration-300">
                Agregar Categoria
            </button>


            @if ($tableCategoria)
                <button type="button" wire:click='closeTableCategoria'
                    class="mt-2 w-full font-medium py-2 rounded-md border border-gray-300 hover:border-gray-500 hover:bg-gray-200">
                    Ocultar Tabla
                </button>
            @else
                <button type="button" wire:click='opneTableCategoria'
                    class="mt-2 w-full font-medium py-2 rounded-md border border-gray-300 hover:border-gray-500 hover:bg-gray-200">
                    Ver Categorias
                </button>
            @endif             
        </form>


        @if ($tableCategoria)        
        <div>
            <table
                class="min-w-full bg-white rounded-b-lg shadow-md hidden md:table">
                <thead class="bg-gray-200 text-gray-800 border-t border-gray-300">
                    <tr>
                        <th class="py-3 px-4 text-left text-semibold">Categorias</th>
                        <th class="py-3 px-4 text-left text-semibold sr-only">Acción</th>
                    </tr>
                </thead>
    
                <tbody class="text-gray-800">
                    @foreach ($categorias as $categoria)
                        <tr wire:key='{{ $categoria->id }}'
                            class="border-t border-gray-200 hover:bg-gray-100 transition duration-300">
                            <td class="py-3 px-4">{{ $categoria->nombre }}</td>
                            <td class="py-3 px-4">
                                <button wire:click='eliminarEspecie({{ $categoria->id }})' type="button"
                                    class="ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    

    </div>

</div>