<div id="confirmarModal" tabindex="-1"
    class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md">

        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="registroFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>
        {{--  --}}
        <form wire:submit.prevent='registroCliente'
            class="bg-white border border-gray-100 p-8 max-w-md mx-auto shadow-lg rounded-lg">
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Registrar Cliente</p>

            <!-- Campo Nombre y Apellido -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Nombre y Apellido</label>
                <input wire:model="rNombre" type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                <p>
                    @error('rNombre')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <!-- Campo Número de Teléfono -->
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Número de RUC o CI</label>
                <input wire:model='rRuc' type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                <p>
                    @error('rRuc')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <button type="submit" class="bg-gray-800 p-2 mt-4 justify-end rounded-lg text-white font-semibold">
                Aceptar
            </button>
            @if ($tablaClientes)
            <button wire:click='tablaClientesFalse' type="button"
            class="cursor-pointer p-2 border border-gray-400 rounded-lg bg-gray-600 hover:border-gray-600 hover:bg-gray-100 font-semibold">
            Ocultar Tabla
        </button>
            @else
            <button wire:click='tablaClientesTrue' type="button"
            class="cursor-pointer p-2 border border-gray-400 rounded-lg hover:border-gray-600 hover:bg-gray-100 font-semibold">
            ver Clientes
        </button>
            @endif            

        </form>
    </div>

    @if ($tablaClientes)
            <div>
                <table class="min-w-full bg-white rounded-lg shadow-md hidden md:table">
                    <thead class="bg-gray-200 text-gray-800 border-t border-gray-300">
                        <tr>
                            <th class="py-3 px-4 text-left text-semibold">Cliente</th>
                            <th class="py-3 px-4 text-left text-semibold sr-only">Acción</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">
                        @foreach ($clientesf as $cliente)
                            <tr wire:key='{{ $cliente->id }}'
                                class="border-t border-gray-200 hover:bg-gray-100 transition duration-300">
                                <td class="py-3 px-4">
                                    <p class="font-semibold">{{ $cliente->nombre_rs }}</p>
                                    <p>{{$cliente->ruc_ci}}</p>
                                </td>
                                <td class="py-3 px-4">
                                    <button wire:confirm='Estas seguro de eliminar este cliente? esta accion de se puede revertir' wire:click='eliminarCliente({{ $cliente->id }})' type="button"
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
