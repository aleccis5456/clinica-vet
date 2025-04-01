<div>
    <div class="">
        @include('includes.sidebar-add-dueno')
    </div>

    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        
        <p class="pl-1 py-7 text-4xl font-semibold">Inventario</p>
        <div class="mb-4">
            <div class="bg-gray-200 rounded-t-lg">            
                <div class="p-4">
                    <button wire:click='openModalAgregar'
                        class="p-2 text-gray-200 rounded-lg bg-gray-800 cursor-pointer font-semibold transition duration hover:bg-gray-700 hover:text-white">
                        Agregar Producto <span class="">+</span>
                    </button>
                    <button wire:click='openModalCategoria'
                    class="p-2 border border-gray-700 text-gray-900 rounded-lg bg-gray-200 cursor-pointer font-semibold transition duration hover:bg-gray-300 hover:font-bold">
                        Agregar Categoria <span class="">+</span>
                    </button>
                    <button wire:click='proveedorTrue'
                    class="p-2 text-gray-900 rounded-lg bg-gray-400 cursor-pointer font-semibold transition duration-200 hover:bg-gray-500 hover:text-gray-100">
                    Agregar Proveedor <span class="">+</span>
                </button>
                </div>
                
                <div class="p-3">
                    <form wire:submit.prevent=''
                        class=" relative h-12 flex items-center gap-2 bg-gray-100 p-2 rounded-md w-full md:w-1/3 border border-gray-300">
                        <!-- Input de búsqueda -->
                        <input wire:model='search' type="text"
                            class="w-full bg-transparent text-sm px-3 py-2 outline-none focus:ring-2 focus:ring-gray-400 rounded-sm"
                            placeholder="Buscar por nombre">

                        <!-- Botón para limpiar el input -->
                        @if ($search)
                            <button type="button" wire:click="flag"
                                class="px-1.5 py-0.5 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-200  transition">
                                ✕
                            </button>
                        @endif

                        <!-- Botón de búsqueda -->
                        <button type="submit" class="bg-gray-200 hover:bg-gray-300 transition p-2 rounded-lg">
                            <svg class="w-5 h-5 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 -3 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="pt-2 ">
                <table class="min-w-full bg-white rounded-lg shadow-md hidden md:table">
                    <thead class="bg-gray-200 text-gray-800 rounded-lg">
                        <tr>
                            <th class="py-3 px-2 text-left text-semibold sr-only">foto</th>
                            <th class="py-3 px-2 text-left text-semibold">Producto</th>
                            <th class="py-3 px-2 text-left text-semibold">Descripcion</th>
                            <th class="py-3 px-2 text-left text-semibold">Categoria</th>
                            <th class="py-3 px-2 text-left text-semibold">Precio</th>
                            <th class="py-3 px-2 text-center text-semibold">Accions</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800 z-50">
                        @foreach ($productos as $producto)
                            <tr wire:key='{{ $producto->id }}' class="hover:bg-gray-100 transition duration-300">
                                <td class="py-3 px-2 max-w-[130px] overflow-visible">
                                    <img class="w-12 h-12  rounded-md hover:scale-[500%] hover:translate-x-16 transition-transform duration-200 ease-in-out"
                                        src="{{ asset("uploads/productos/$producto->foto") }}" alt="">
                                </td>
                                <td class="py-3 px-2">{{ $producto->nombre }}</td>
                                <td class="py-3 px-2 max-w-[280px]">                                    
                                    @if ($producto->id == $productoId)
                                        {{ $producto->descripcion }}
                                        <span wire:click='closeVerTodo()'
                                            class="cursor-pointer underline text-red-300">ver menos
                                        </span>
                                    @else
                                        {{ Str::words($producto->descripcion, 9, ' ') }}
                                        <span wire:click='openVerTodo({{ $producto->id }})'
                                            class="cursor-pointer underline text-blue-600">ver mas
                                        </span>
                                    @endif

                                </td>
                                <td class="py-3 px-2">
                                    {{ $producto->tipoCategoria->nombre }}
                                </td>
                                <td class="py-3 px-2">{{ App\Helpers\Helper::formatearMonto($producto->precio) }} Gs.
                                </td>
                                <td class="py-3 px-2 font-semibold">
                                    <button wire:click="detallesTrue({{ $producto->id }})" type="button"
                                        class="cursor-pointer text-gray-800 border border-gray-500 hover:bg-gray-300  focus:ring-2 focus:ring-gray-400 rounded-md px-3 py-1 text-sm">
                                        Detalles
                                    </button>
                                    <button wire:click="editarTrue({{ $producto->id }})" type="button"
                                        class="cursor-pointer text-gray-800 bg-gray-200 hover:bg-gray-300  focus:ring-2 focus:ring-gray-400 rounded-md px-3 py-1 text-sm">
                                        Editar
                                    </button>
                                    <button wire:click='alertaTrue({{ $producto->id }})' type="button"
                                        class="ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    @if ($modalAgregar)
        @include('includes.inventario.modalAddProductos')
    @endif

    @if ($modalCategoria)
        @include('includes.inventario.modalAddCategoria')
    @endif
    
    @if ($editar)
        @include('includes.inventario.modalEditarProducto')
    @endif
    
    @if ($detalles)
        @include('includes.inventario.modal-detalles')
    @endif

    @if ($historial)
        @include('includes.inventario.historial-ventas')
    @endif

    @if ($modalProveedor)
        @include('includes.inventario.proveedor')
    @endif

    @if ($alertaDelete)
        @include('includes.inventario.delete')
    @endif
</div>
