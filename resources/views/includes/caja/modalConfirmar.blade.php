<div id="confirmarModal" tabindex="-1"
    class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md">

        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="confirmarFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>
        {{--  --}}
        <form wire:submit.prevent='confirmarPago'
            class="bg-white border border-gray-100 p-4 max-w-md mx-auto shadow-lg rounded-lg">
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Confirmar Pago</p>
            <div class="mb-4">
                <div class="mb-4 bg-gray-50 p-2 rounded-lg shadow-md">
                    <label class="block text-gray-800 font-medium mb-2">método de pago</label>
                    <select wire:model="formaPago"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                        <option value="">-Elegir-</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="efectivo">Tarjeta</option>
                        <option value="transf">Transferencia</option>
                        <option value="otro">QR</option>
                    </select>
                </div>
                @error('formaPago')
                    <span class="text-red-700 underline">{{ $message }}</span>
                @enderror

                <div class="border-t border-gray-200">
                    <div class='mt-2 mb-2 border border-gray-300 p-2 rounded-lg'>
                        <div class="flex">
                            <p class='p-1 font-semibold'>Nombre o Razón Social: </p>
                            <span class="p-1">{{ $nombreRS }}</span>
                        </div>
                        <div class="flex">
                            <p class='p-1 font-semibold'>RUC o CI: </p>
                            <span class="p-1">{{ $rucCI }}</span>
                        </div>
                    </div>
                    
                    <div class="p-3 shadow-xs mb-3 border border-gray-200 rounded-lg">
                        <p class="font-semibold text-gray-600">producto y/o servicios</p>
                        <table>
                            <thead>
                                <tr>
                                    <th class="sr-only">cantidad</th>
                                    <th class="sr-only">imagen</th>
                                    <th class="sr-only">producto</th>
                                    <th class="sr-only">precio unitario</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach (session('cobro') as $item)
                                    <tr>
                                        <td class='p-2'>{{ $item['cantidad'] }}</td>
                                        <td class='p-3'>
                                            @if (isset($item['productoCompleto']->foto))
                                                <img class="w-12 h-12 pr-1"
                                                    src="{{ asset('uploads/productos/' . $item['productoCompleto']->foto) }}"
                                                    alt="">
                                            @else
                                                <img src="{{ asset('images/tabicon.png') }}" alt="">
                                            @endif
                                        </td>
                                        <td class="p-2">{{ $item['producto'] }}</td>
                                        <td class="p-2">{{ $item['precio'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between bg-gray-200 shadow-md p-3 rounded-lg">
                        <p class="font-semibold ">Total</p>
                        <p class="text-lg">{{ App\Helpers\Helper::formatearMonto(App\Helpers\Helper::total()) }} Gs.</p>
                    </div>

                    <div class="py-4 flex justify-end">
                        <button type="submit"
                        class="cursor-pointer bg-green-500 p-3 font-semibold text-white hover:bg-green-600 hover:shadow-lg">
                        Confirmar
                        </button>

                    </div>
                </div>                
            </div>
        </form>
    </div>
</div>

<!--
'efectivo','tarjeta','transferencia','otro'
-->
