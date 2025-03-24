<div>
    <div>
        @include('includes.sidebar-add-dueno')
    </div>
    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        <p class="pl-1 py-7 text-4xl font-semibold">Historial</p>
        <div class="mb-4 border-t border-gray-400 p-4 flex flex-col md:flex-row ">

            <div class="bg-white rounded-lg shadow-sm p-4  h-full">
                <!-- Sección de imagen -->
                <div class="mb-5 rounded-lg overflow-hidden bg-gray-100">
                    <img 
                        src="{{ asset('uploads/mascotas/' . $mascota->foto) }}" 
                        alt="Foto de {{ $mascota->nombre }}"
                        class="w-full h-48 object-cover transition-transform hover:scale-105"
                        onerror="this.src='{{ asset('img/pet-placeholder.png') }}'"
                    >
                </div>
            
                <!-- Detalles de la mascota -->
                <div class="flex-1">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18s-3.332.477-4.5 1.253"></path></svg>
                        {{ $mascota->nombre }}
                    </h3>
            
                    <div class="space-y-3 text-sm">
                        <p class="flex items-center gap-2 text-gray-700">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Dueño: <span class="font-medium">{{ $mascota->dueno->nombre }}</span>
                        </p>
            
                        <p class="flex items-center gap-2 text-gray-700">
                            <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V3m8 4V3m-4 10V7m4 4h-6a2 2 0 01-2-2V3"></path></svg>
                            Consultas realizadas: 
                            <span class="bg-purple-100 text-purple-600 px-2 py-0.5 rounded-full">{{ count($cantidad) }}</span>
                        </p>
            
                        <p class="flex items-center gap-2 text-gray-700">
                            <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Última consulta: 
                            <span class="font-medium">{{ \Carbon\Carbon::parse($fecha->fecha)->format('d/m/Y') }}</span>
                        </p>
                    </div>
                </div>
                            
            </div>

            <div class=" w-3/4 p-2">
                <div class="min-h-[400px] border border-gray-100 shadow-sm rounded-lg">
                    <table class="min-w-full bg-white rounded-lg hidden md:table">
                        <thead class="bg-gray-200 text-gray-800 ">
                            <tr>
                                <th class="py-3 px-4 text-left text-semibold">Fecha</th>
                                <th class="py-3 px-4 text-left text-semibold">Código</th>
                                <th class="py-3 px-4 text-left text-semibold">Tipo de consulta</th>
                                <th class="py-3 px-4 text-left text-semibold">Acciones</th>
                                <th class="py-3 px-4 text-left text-semibold">detalle</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800">
                            @foreach ($consultas as $consultaf)
                                <tr wire:key='{{ $consultaf->id }}'
                                    class="border-t border-gray-200 hover:bg-gray-100 transition duration-300">
                                    <td class="py-3 px-4">{{ \Carbon\Carbon::parse($consultaf->fecha)->format('d/m/Y') }}</td>
                                    <td class="py-3 px-4">{{ $consultaf->codigo }}</td>
                                    <td class="py-3 px-4">{{ $consultaf->tipoConsulta->nombre }}</td>
                                    <td class="py-3 px-4 hover:underline cursor-pointer">
                                        <button wire:click='' type="button"
                                            class="cursor-pointer ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-red-300 rounded-md px-3 py-1 text-sm">
                                            Eliminar
                                        </button>
                                    </td>

                                    <td class="py-3 px-4 font-semibold">
                                        @if (!$flag)
                                            <button type="button" wire:click='filtro({{ $consultaf->id }})'>
                                                <svg class="cursor-pointer w-6 h-6 text-gray-800" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                                                </svg>
                                            </button>
                                        @else
                                            <button class="cursor-pointer" type="button" wire:click='flagFalse'>
                                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m5 15 7-7 7 7" />
                                                </svg>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($flag)
                        <div class="p-4 bg-gray-100 rounded-lg shadow-sm">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Detalles
                                de la Consulta</h2>

                            <!-- Información de veterinarios -->
                            <div class="mb-6">
                                <div class="bg-white p-4 rounded-lg shadow-xs mb-3">
                                    <p class="text-sm text-gray-600 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        Atendido por: <span
                                            class="font-medium">{{ $consulta->veterinario->name }}</span>
                                        | {{ $consulta->veterinario->rol->name }}
                                    </p>
                                </div>

                                @if ($consultaVeterinario->isNotEmpty())
                                    <div class="bg-white p-4 rounded-lg shadow-xs">
                                        <p class="text-sm text-gray-600 mb-2">Otros doctores participantes:</p>
                                        <ul class="space-y-1">
                                            @foreach ($consultaVeterinario as $vet)
                                                @if ($vet->consulta_id == $consulta->id)
                                                    <li
                                                        class="flex items-center gap-2 text-xs text-gray-700 pl-5 relative before:absolute before:left-0 before:top-2 before:w-1 before:h-1 before:bg-gray-400 before:rounded-full">
                                                        {{ $vet->veterinario->name }} |
                                                        {{ $vet->veterinario->rol->name }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <!-- Productos consumidos -->
                            <div class="mb-6">
                                <h3 class="text-md font-medium text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Insumos consumidos
                                </h3>

                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                                    @foreach ($productos as $producto)
                                        <div
                                            class="bg-white rounded-lg p-3 shadow-xs hover:shadow-md transition-shadow">
                                            <div class="aspect-w-1 aspect-h-1 mb-2">
                                                <img class="object-cover rounded-md w-full h-full"
                                                    src="{{ asset('uploads/productos/' . $producto->producto->foto) }}"
                                                    alt="{{ $producto->producto->nombre }}">
                                            </div>
                                            <div class="text-center">
                                                <p class="text-xs font-medium text-gray-800 line-clamp-2">
                                                    {{ $producto->producto->nombre }}</p>
                                                <p class="text-[10px] text-gray-500 mt-1">
                                                    {{ $producto->producto->precio }} Gs.</p>
                                                <p class="text-[10px] text-gray-500">Cantidad:
                                                    {{ $producto->cantidad }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @php
                                $precioProducto = [];
                                $precioConsulta = $consulta->tipoConsulta->precio;
                                $totalProducto = 0;
                                foreach ($productos as $producto) {
                                    $precioProducto[] = [
                                        'precio' => $producto->producto->precio,
                                        'cantidad' => $producto->cantidad
                                    ];
                                }
                                
                                foreach($precioProducto as $pProducto){
                                    $totalProducto += (int)$pProducto['cantidad']*(int)$pProducto['precio'];
                                }
                                
                                $total = $totalProducto+$precioConsulta;
                                
                            @endphp                                
                            <!-- Total -->
                            <div class="bg-white p-4 rounded-lg shadow-xs">
                                <div class="flex justify-between items-center border-t border-gray-100 pt-3 mt-3">
                                    <p class="text-sm font-medium text-gray-700">Total:</p>
                                    <p class="text-lg font-semibold text-blue-600">
                                        {{ App\Helpers\Helper::formatearMonto($total) }} Gs.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>
