<div>
    <div>
        @include('includes.sidebar-add-dueno')
    </div>

    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        <p class="pl-1 py-7 text-4xl font-semibold">Reportes</p>

        <div class="grid grid-cols-3 gap-4 px-12">
            <div class="col-span-2 bg-gray-100 rounded-lg p-4 ">
                <p>Productos mas vendidos</p>
                <div class="mt-2 rounded-lg overflow-hidden shadow-md ">
                    <table class="min-w-full bg-white rounded-lg hidden md:table">
                        <thead class="bg-gray-200 text-gray-800 border-t border-gray-300">
                            <tr>
                                <th class="py-3 px-4 text-left text-semibold sr-only">foto</th>
                                <th class="py-3 px-4 text-left text-semibold">Producto</th>
                                <th class="py-3 px-4 text-left text-semibold">Ventas</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-800">                        
                                <tr wire:key=''
                                    class="border-t border-gray-200 hover:bg-gray-100 transition duration-300">
                                    <td class="py-3 px-4"></td>
                                    <td class="py-3 px-4"></td>
                                    <td class="py-3 px-4"></td>
                                </tr>                        
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-gray-100 h-48 rounded-lg">

            </div>

            <div class="bg-gray-100 h-24 rounded-lg">

            </div>

            <div class="bg-gray-100 h-24 rounded-lg">

            </div>

            <div class="bg-gray-100 p-2 rounded-lg">
                <p class="font-semibold text-xl">Cantidad por especies</p>
                <div class="flex">
                    @foreach ($especies as $especie)
                        <div class="bg-gray-300/80 p-4 m-1 rounded-lg flex">
                            <p class="font-semibold mr-1">{{ Str::ucfirst($especie->nombre) }}: </p>
                            @php
                                $cantidad = 0;
                                $mascotas = App\Models\Mascota::where('especie_id', $especie->id)->get();

                                $cantidad = count($mascotas);
                            @endphp
                            <span> {{ $cantidad }}</span>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- <div class="border-t border-gray-400 p-4 grid grid-cols-2">            
            <div class=" p-2">
                <div class="flex">
                    @foreach ($especies as $especie)
                    <div class="bg-gray-300/80 p-4 m-1 rounded-lg flex">
                        <p class="font-semibold mr-1">{{Str::ucfirst($especie->nombre) }}: </p>
                        @php
                            $cantidad = 0;
                            $mascotas = App\Models\Mascota::where('especie_id', $especie->id)->get();
                            
                            $cantidad = count($mascotas);                            
                        @endphp                
                        <span> {{ $cantidad }}</span>
                        
                    </div>
                    @endforeach                                        
                </div>
            </div>

            <div class="border border-red-500 p-2">
                <p>Productos mas vendidos</p>
                <div class="mt-2 rounded-lg overflow-hidden shadow-md ">
                    <table class="min-w-full bg-white rounded-lg hidden md:table">
                        <thead class="bg-gray-200 text-gray-800 border-t border-gray-300">
                            <tr>
                                <th class="py-3 px-4 text-left text-semibold sr-only">foto</th>
                                <th class="py-3 px-4 text-left text-semibold">Nombre</th>
                                <th class="py-3 px-4 text-left text-semibold">Especie</th>
                                <th class="py-3 px-4 text-left text-semibold">Raza</th>
                                <th class="py-3 px-4 text-left text-semibold">Cumpleaños</th>
                                <th class="py-3 px-4 text-left text-semibold">Humano</th>
                                <th class="py-3 px-4 text-left text-semibold">Acciones</th>
                            </tr>
                        </thead>
    
                        <tbody class="text-gray-800">
                            @foreach ($mascotas as $mascota)
                                <tr wire:key='{{ $mascota->id }}'
                                    class="border-t border-gray-200 hover:bg-gray-100 transition duration-300">
                                    <td class="py-3 px-4"><img class="w-12 h-12 rounded-full"
                                            src="{{ asset("uploads/mascotas/$mascota->foto") }}" alt=""></td>
                                    <td class="py-3 px-4">{{ $mascota->nombre }} ({{ $mascota->genero }})</td>
                                    <td class="py-3 px-4"> {{ $mascota->especieN->nombre }} </td>
                                    <td class="py-3 px-4"> {{ $mascota->raza }} </td>
                                    <td class="py-3 px-4"> {{ App\Helpers\Helper::formatearFecha($mascota->nacimiento) }}
                                    </td>
                                    <td class="py-3 px-4"> {{ $mascota->dueno->nombre }} </td>
                                    <td class="py-3 px-4 font-semibold">
                                        <button wire:click="openModalEdit({{ $mascota->id }})"
                                            class="cursor-pointer text-gray-800 bg-gray-200 hover:bg-gray-300 focus:ring-2 focus:ring-gray-400 rounded-md px-3 py-1 text-sm">
                                            Editar
                                        </button>
                                        <button wire:click='openModalEliminar({{ $mascota->id }})' type="button"
                                            class="ml-2 text-white bg-gray-800 hover:bg-black focus:ring-2 focus:ring-black rounded-md px-3 py-1 text-sm">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div> --}}

    </main>
</div>
