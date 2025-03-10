<div>
    <div>
        @include('includes.sidebar-add-dueno')
    </div>    
    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        <p class="pl-1 py-7 text-4xl font-semibold">Historial</p>
        <div class="mb-4 border-t border-gray-400 flex p-4">

            <div class="border border-blue-400 flex flex-col min-h-[500px] p-2 w-1/4 bg-gray-200 rounded-lg shadow-md">
                <div class="">
                    <div class="border border-green-700 h-auto mb-5 rounded-lg">
                        <img class="rounded-lg" src="{{ asset("uploads/mascotas/$mascota->foto") }}" alt="" srcset="">
                    </div>
    
                    <div class="border border-yellow-500">
                        <p class="text-xl font-semibold">Nombre: <span>{{$mascota->nombre}}</span></p>
                        <p>Dueño: <span>{{ $mascota->dueno->nombre }}</span></p>
                    </div>
                </div>                
            </div>

            <div class="border border-red-500 w-3/4 p-2">
                <div class="border min-h-[400px]">

                </div>
            </div>
        </div>
    </main>
</div>
