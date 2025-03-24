<div id="confirmarModal" tabindex="-1"
    class=" fixed top-0 right-0 left-0  z-40 flex justify-center items-center w-full h-full bg-black/50 outline-none overflow-x-hidden overflow-y-auto">
    <div class="relative p-4 w-lg md:w-5xl ">

        <button type="button"
            class="m-2 absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="historialFalse({{ $detalleProducto->id }})">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <div class="bg-white border border-gray-200 rounded-lg shadow-lg mx-auto max-w-5xl overflow-hidden ">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Historial de ventas</h2>
                <p class="text-center font-semibold text-xl">{{ $detalleProducto->nombre }}</p>

                <div class="pt-2 ">
                    <table class="min-w-full bg-white rounded-lg shadow-md hidden md:table">
                        <thead class="bg-gray-200 text-gray-800 rounded-lg">
                            <tr>                                
                                <th class="py-3 px-2 text-left text-semibold">fecha</th>
                                <th class="py-3 px-2 text-left text-semibold">Datos</th>
                                <th class="py-3 px-2 text-left text-semibold">cantidad</th>
                                <th class="py-3 px-2 text-left text-semibold">total</th>                                
                            </tr>
                        </thead>
    
                        <tbody class="text-gray-800 z-50">
                            @foreach ($ventas as $venta)
                                <tr wire:key='{{ $venta->id }}' class="hover:bg-gray-100 transition duration-300">                                    
                                    <td class="py-3 px-2">{{ $venta->created_at }}</td>
                                    <td class="py-3 px-2">{{ $venta->movimiento->cliente }}</td>
                                    <td class="py-3 px-2">{{ $venta->cantidad }}</td>
                                    <td class="py-3 px-2">{{ $venta->precio_total }}</td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>