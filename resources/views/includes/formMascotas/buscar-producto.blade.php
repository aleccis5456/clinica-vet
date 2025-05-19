<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0 z-40 flex justify-center items-center w-full h-full bg-black/50 outline-none overflow-x-hidden overflow-y-auto">
    <div class="relative p-4 w-lg md:w-md ">

        <button type="button"
            class="cursor-pointer m-2 absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="productosFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>
        <div class="h-auto w-full bg-white p-6 rounded-xl shadow-lg max-w-md mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Buscar Vacuna</h2>

            <form wire:submit.prevent="filtrarProductos" class="w-full space-y-6">
                <div class="flex items-center border border-gray-300 rounded-lg px-3 py-2 bg-gray-50">
                    <input type="text" wire:model="producto" placeholder="Buscar producto..."
                        class="w-full bg-transparent outline-none text-gray-700" autocomplete="off">
                    <button type="submit" class="ml-2 text-white bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg">
                        Buscar
                    </button>
                </div>
            </form>

            @if ($productosEncontrados)
                <div class="mt-4">
                    <h3 class="text-lg font-semibold text-gray-800">Resultados de búsqueda:</h3>
                    <ul class="mt-2">
                        @foreach ($response as $producto)
                            <li class="flex items-center justify-between bg-gray-100 p-2 border border-gray-200 rounded-lg mb-2">
                                <span class="text-gray-700">{{ $producto->nombre }}</span>
                                <button wire:click="setProducto({{ $producto->id }})"
                                    class="cursor-pointer bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                                    Seleccionar
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @if ($response->isEmpty())
                        <p class="text-gray-500">No se encontraron productos.</p>
                    @endif
                </div>

            @endif
        </div>
    </div>
</div>
