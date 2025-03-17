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
                        <p class="pl-4 pt-2 font-semibold text-lg flex">
                            Consultas Pendientes
                            <button
                                @if ($alertas) wire:click="alertaFalse" @else wire:click="alertaTrue" @endif
                                class="ml-2 flex cursor-pointer text-sm px-2 py-1 bg-orange-200 rounded-full text-orange-600">
                                {{ count(session('caja')) }}
                                <span>
                                    @if ($alertas)
                                        <svg class="w-5 h-5 text-orange-600" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m5 15 7-7 7 7" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-orange-600" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 9-7 7-7-7" />
                                        </svg>
                                    @endif

                                </span>


                            </button>
                        </p>
                        @if ($alertas)
                            <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                @if (session('caja'))
                                    @foreach (session('caja') as $caja)
                                        <div
                                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow relative group">                                            
                                            <!-- Contenido principal -->
                                            <div class="p-4 cursor-pointer">
                                                <p class="text-xs text-gray-500">Código: {{ $caja['consulta']->codigo }}</p>
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

                                            {{-- <div
                                                class="absolute top-0 left-0 right-5 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button wire:click='cobrarConsulta({{ $caja['consultaId'] }})'
                                                    class="cursor-pointer max-w-1/4 h-10 backdrop-blur-xs bg-black/50 hover:bg-black/90 text-white font-bold p-2 rounded-full ">
                                                    <svg class="w-6 h-6 text-gray-100 " aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
                                                    </svg>
                                                </button>
                                            </div> --}}


                                            <!-- Botón de cobro (aparece al pasar el mouse) -->
                                            <div
                                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-white via-white to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button wire:click='cobrarConsulta({{ $caja['consultaId'] }})'
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
                                    class="bg-gradient-to-r from-gray-700 to-gray-800 gap-4 text-white font-semibold p-3 rounded-lg"
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
                                        <tr wire:key='{{ $producto->id }}'
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
                                                @if (session('activo') != true)
                                                    <button wire:click='cobro({{ $producto->id }})' type="button"
                                                        class="cursor-pointer ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                                        Agregar
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div @endif
                </div>
            </div>

            <!-- SECCIÓN DE LOS DATOS PARA EL COBRO -->
            <div class="w-full md:w-1/3 lg:w-1/4 shadow-md rounded-lg bg-white p-5">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">
                    Productos y Servicios
                </h3>

                <form wire:submit.prevent='nombreFactura' class="space-y-4">
                    <!-- Campo RUC/CI -->
                    <div class="relative">
                        <label for="rucCI" class="block text-sm font-medium text-gray-700 mb-1">RUC o CI</label>
                        <input wire:model='rucCI' type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent disabled:bg-gray-100"
                            placeholder="Ingrese RUC o CI" @if (!session('cobro')) disabled @endif>
                        @if (!empty($rucCI))
                            <button type="button" wire:click="$set('rucCI', '')"
                                class="text-xl cursor-pointer absolute right-1 top-11 transform -translate-y-1/2 text-gray-400 hover:text-gray-900 hover:bg-gray-300 px-2 hover:rounded-md">
                                x
                            </button>
                        @endif

                        <p>
                            @error('rucCI')
                                <span class="text-red-700 underline">{{ $message }}</span>
                            @enderror
                        </p>
                    </div>

                    <!-- Campo Nombre/Razón Social -->
                    <div class="relative">
                        <label for="nombreRS" class="block text-sm font-medium text-gray-700 mb-1">Nombre o Razón
                            Social</label>
                        <input wire:model="nombreRS" type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent disabled:bg-gray-100"
                            placeholder="Ingrese nombre o razón social"
                            @if (!session('cobro')) disabled @endif>
                        @if (!empty($nombreRS))
                            <button type="button" wire:click="$set('nombreRS', '')"
                                class="text-xl cursor-pointer absolute right-1 top-11 transform -translate-y-1/2 text-gray-400 hover:text-gray-900 hover:bg-gray-300 px-2 hover:rounded-md">
                                x
                            </button>
                        @endif

                        <p>
                            @error('nombreRS')
                                <span class="text-red-700 underline">{{ $message }}</span>
                            @enderror
                        </p>
                    </div>

                    <button type="submit" class="hidden"></button>
                </form>

                <!-- Lista de productos seleccionados -->
                @if (session('cobro'))
                    <div class="mt-6 space-y-3">
                        <p class="text-sm font-semibold text-gray-600">Productos y/o servicios seleccionados:</p>

                        @foreach (session('cobro') as $index => $cobro)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md shadow-sm">
                                <div class="flex items-center">
                                    <!-- Botones de cantidad -->
                                    <div class="relative flex items-center mr-1">
                                        <!-- Botón de restar -->
                                        @if (!session('activo'))
                                            <button wire:click.debounce.300ms="disminuir({{ $index }})"
                                                class="shrink-0 bg-gray-100 hover:bg-gray-200 text-gray-500 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-200 focus:ring-2 focus:outline-none">
                                                <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>
                                        @endif

                                        <!-- Input con cantidad -->
                                        <input type="text" id="counter-input"
                                            class="shrink-0 text-gray-900 border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[1rem] text-center"
                                            value="{{ $cobro['cantidad'] }}" disabled />

                                        <!-- Botón de sumar -->
                                        @if (!session('activo'))
                                            <button
                                                wire:click='cobro({{ $cobro['productoId'] }}, {{ $index }})'
                                                class="shrink-0 bg-gray-100 hover:bg-gray-200 text-gray-500 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-200 focus:ring-2 focus:outline-none">
                                                <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Nombre del producto -->
                                    <p class="text-xs text-gray-800">{{ $cobro['producto'] }}</p>
                                </div>
                                <!-- Precio -->
                                <span
                                    class="text-xs text-gray-700">{{ App\Helpers\Helper::formatearMonto($cobro['precio']) }}
                                    Gs.</span>
                            </div>
                        @endforeach
                        <div class="flex justify-between mt-6">
                            <p class="text-lg font-semibold">Total</p>
                            <p class="text-xl">{{ App\Helpers\Helper::formatearMonto(App\Helpers\Helper::total()) }}
                                Gs.</p>
                        </div>

                        <div class="bg-gray-100">
                            <button wire:click='confirmarTrue'
                                class="cursor-pointer bg-green-500 p-3 font-semibold text-white hover:bg-green-600 hover:shadow-lg">
                                Siguiente
                            </button>

                            <button wire:click='borrarCobro'
                                class="cursor-pointer bg-red-500 p-3 font-semibold text-white hover:bg-red-600 hover:shadow-lg">
                                Cancelar
                            </button>
                        </div>
                    </div>
                @endif
            </div>

        </div>


        @if ($resultados)
            @include('includes.caja.modalResultados')
        @endif

        @if ($registro)
            @include('includes.caja.modalRegistro')
        @endif

        @if ($confirmar)
            @include('includes.caja.modalConfirmar')
        @endif
    </main>
</div>
