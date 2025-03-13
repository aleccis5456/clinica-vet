<div>
    <div>
        @include('includes.sidebar-caja')
    </div>

    <main class="pl-18 pr-6 py-6 ">

        <div class="flex flex-col md:flex-row p-2">
            <div class="w-3/4 p-0.5">
                <p class="pl-1 py-7 text-4xl font-semibold">Caja</p>
                <div class="mb-4  rounded-lg">
                    <div class="bg-gray-200 rounded-lg ">
                        <p class="pl-4 pt-2 font-semibold text-lg">
                            Consultas Pendientes
                            <span  @if($alertas) wire:click="alertaFalse" @else wire:click="alertaTrue" @endif                        
                                class="cursor-pointer text-sm px-2 py-1 bg-orange-200 rounded-full text-orange-600">{{ count(session('caja')) }}</span>
                        </p>                    
                        @if ($alertas)                            
                            <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                @if (session('caja'))
                                    @foreach (session('caja') as $caja)
                                        <div
                                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow relative group">
                                            <!-- Contenido principal -->
                                            <div class="p-4 cursor-pointer">
                                                <div class="flex justify-between items-start mb-2">
                                                    <div>
                                                        <p class="font-bold text-gray-800">
                                                            {{ $caja['cliente']['nombre'] }}
                                                        </p>
                                                    </div>

                                                    @foreach ($estados as $estado => $bg)
                                                        @if ($estado == $caja['pagoEstado'])
                                                            <div
                                                                class="{{ $bg }} {{ $estado == $caja['pagoEstado'] ? 'text-orange-600' : 'text-yellow-600' }} px-2 py-1 rounded-full text-xs">
                                                                {{ $estado }}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="justify-between flex text-gray-500">
                                                    <p class="text-sm ">
                                                        {{ $caja['consulta']->tipoConsulta->nombre }}
                                                    </p>
                                                    <span class="text-xs">
                                                        {{ App\Helpers\Helper::formatearMonto($caja['consulta']->tipoConsulta->precio) }}
                                                        Gs.
                                                    </span>
                                                </div>
                                                <div class="space-y-1 mb-3">
                                                    @foreach ($caja['productos'] as $producto)
                                                        <div class="flex justify-between text-xs text-gray-600">
                                                            <p>{{ $producto['cantidad'] }}
                                                                {{ Str::limit($producto['producto'], 17, '...') }}</p>
                                                            <p>{{ App\Helpers\Helper::formatearMonto($producto['precio']) }}
                                                                Gs.</p>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="border-t border-gray-100 pt-2">
                                                    <p class="font-semibold text-lg text-gray-800">
                                                        Total:
                                                        {{ App\Helpers\Helper::formatearMonto($caja['montoTotal']) }}
                                                        Gs.
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Botón de cobro (aparece al pasar el mouse) -->
                                            <div
                                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-white via-white to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button
                                                    class="cursor-pointer  w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                                    <i class="fas fa-cash-register mr-2"></i> Cobrar
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        @endif
                        <div class="p-3 flex">
                            <!-- Buscador -->                            
                            <form wire:submit.prevent='filtrar'
                                class=" relative h-12 flex items-center gap-2 bg-gray-100 p-2 rounded-md w-full md:w-1/3 border border-gray-300">
                                <!-- Input de búsqueda -->
                                <div>
                                    
                                </div>
                                <input wire:model='search' type="text"
                                    class="w-full bg-transparent text-sm px-3 py-2 outline-none focus:ring-2 focus:ring-gray-400 rounded-sm"
                                    placeholder="Buscar producto o servicio">

                                <!-- Botón para limpiar el input -->
                                @if ($search)
                                    <button type="button" wire:click="flag"
                                        class="px-1.5 py-0.5 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-200  transition">
                                        ✕
                                    </button>
                                @endif

                                <!-- Botón de búsqueda -->

                                <button type="submit" class="bg-gray-200 hover:bg-gray-300 transition p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-gray-700" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 -3 21 21">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </button>                                
                            </form>

                            <div class="pl-1">
                                <select wire:model='opcion'
                                        class="border border-gray-300 p-3 rounded-lg"
                                        name="" id="">                                    
                                    <option value="1">Productos</option>
                                    <option value="2">Consultas</option>
                                </select>
                            </div>
                            
                        </div>
                        
                    </div>

                    @if ($tablaProductos)
                        <div class="mt-2 rounded-lg overflow-hidden shadow-md ">
                            <table class="min-w-full bg-white rounded-lg hidden md:table">
                                <thead class="bg-gray-200 text-gray-800 ">
                                    <tr>
                                        <th class="py-3 px-4 text-left text-semibold sr-only">foto</th>
                                        <th class="py-3 px-4 text-left text-semibold">Producto</th>
                                        <th class="py-3 px-4 text-left text-semibold">Precio</th>
                                        <th class="py-3 px-4 text-left text-semibold">stock</th>
                                        <th class="py-3 px-4 text-left text-semibold sr-only">Agregar</th>
                                    </tr>
                                </thead>

                                <tbody class="text-gray-800">
                                    @foreach ($productos as $producto)
                                        <tr wire:key=''
                                            class="border-t border-gray-200 hover:bg-gray-100 transition duration-300">
                                            <td class="py-3 px-4">
                                                <img class="w-18 h-18"
                                                    src="{{ asset("uploads/productos/$producto->foto") }}"
                                                    alt="" srcset="">
                                            </td>
                                            <td class="py-3 px-4">
                                                {{ $producto->nombre }}
                                            </td>
                                            <td class="py-3 px-4">
                                                {{ App\Helpers\Helper::formatearMonto($producto->precio) }} Gs.
                                            </td>
                                            <td class="py-3 px-4">
                                                {{ $producto->stock_actual }}
                                            </td>

                                            <td class="py-3 px-4 font-semibold">
                                                <button wire:click='' type="button"
                                                    class="ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                                    Agregar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div 
                    @endif
                </div>
            </div>

            <div class="border border-amber-400 w-1/4">

            </div>
        </div>

    </main>
</div>
