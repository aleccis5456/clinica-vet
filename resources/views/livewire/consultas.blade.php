<div class="">
    <!-- Sidebar -->
    <div class="">
        @include('includes.sidebar-add-dueno')
    </div>

    <main class="ml-0 md:ml-64 md:pl-20 md:pt-2 pt-16 pl-2 pr-4">
        <p class="pl-1 py-7 text-4xl font-semibold">Consultas <span class="text-lg"> | Historial clinico</span></p>
        <div class="mb-4 rounded-lg">
            <div class="bg-gray-200 rounded-lg ">
                <div class="p-4">
                    <button wire:click='opneAddConsulta'
                        class="p-2 border border-gray-900 text-white rounded-lg bg-gray-800 cursor-pointer font-semibold hover:bg-gray-700 hover:font-bold">
                        Registrar Consulta <span>+</span>
                    </button>

                    <button wire:click='openTipoConsulta'
                        class="p-2 border border-gray-700 text-gray-900 rounded-lg bg-gray-200 cursor-pointer font-semibold hover:bg-gray-300 hover:font-bold">
                        Agregar Tipo de Consulta <span>+</span>
                    </button>
                </div>

                <div class="px-4">
                    @livewire('alerta-agendados')
                </div>

                <div class="p-3 flex">
                    <form wire:submit.prevent='busqueda'
                        class=" relative h-12 flex items-center gap-2 bg-gray-100 p-2 rounded-l-md w-full md:w-1/3 border border-gray-300">
                        <!-- Input de búsqueda -->
                        <input wire:model='search' type="text"
                            class="w-full bg-transparent text-sm px-3 py-2 outline-none focus:ring-2 focus:ring-gray-400 rounded-sm"
                            placeholder="Buscar por nombre">

                        <!-- Botón para limpiar el input -->
                        @if ($search)
                            <button type="button" wire:click="flagC"
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
                    <div>
                        <select wire:model='estadofiltrado' wire:click='filtarPorEstados'
                            class="bg-gray-800 h-12 rounded-r-md text-white text-center">
                            <option selected value="1">Todos</option>
                            @foreach ($estadosf as $tipo)
                                <option value="{{ $tipo }}">{{ $tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="py-10 grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $estados = [
                        'Agendado' => 'from-sky-400 to-sky-500 hover:from-sky-500 hover:to-sky-600',
                        'En seguimiento' => 'from-indigo-500 to-indigo-700 hover:from-indigo-600 hover:to-indigo-800',
                        'Internado' => 'from-red-700 to-red-800 hover:from-red-800 hover:to-red-900',
                        'Pendiente' => 'from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600',
                        'En recepción' => 'from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700',
                        'En consultorio' => 'from-green-500 to-green-600 hover:from-green-600 hover:to-green-700',
                        'Finalizado' => 'from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800',
                        'No asistió' => 'from-gray-400 to-gray-500 hover:from-gray-500 hover:to-gray-600',
                        'Cancelado' => 'from-rose-500 to-rose-700 hover:from-rose-600 hover:to-rose-800',
                    ];

                    $estadosf = [
                        'Agendado' => 'bg-sky-200 border-sky-300',
                        'En seguimiento' => 'bg-indigo-200 border-indigo-300',
                        'Internado' => 'bg-red-200 border-red-300',
                        'Pendiente' => 'bg-amber-100 border-amber-300',
                        'En recepción' => 'bg-yellow-100 border-yellow-300',
                        'En consultorio' => 'bg-green-200 border-green-300',
                        'Finalizado' => 'bg-gray-200 border-gray-300',
                        'No asistió' => 'bg-gray-200 border-gray-400',
                        'Cancelado' => 'bg-rose-200 border-rose-300',
                    ];
                @endphp
                
                @foreach ($consultas as $consulta)
                    <div class="max-w-[270px] shadow-md rounded-lg overflow-hidden transition-all duration-200 hover:scale-101 hover:shadow-lg relative 
                            border {{ $estadosf[$consulta->estado] ?? 'bg-gray-200 border-gray-300' }}"
                        id="consulta-{{ $consulta->id }}">
                        <!-- Tag de estado con degradado -->
                        <select name="" id=""
                            wire:change='updateEstado({{ $consulta->id }}, $event.target.value)'
                            class="cursor-pointer estado-select absolute top-2 left-2 z-10 px-2 py-0.5 text-xs font-semibold text-black rounded-lg
                                bg-gradient-to-r {{ $estados[$consulta->estado] ?? 'from-gray-300 to-gray-400 hover:from-gray-400 hover:to-gray-500' }}"
                            onchange="cambiarColor(this)">
                            @foreach ($estados as $estado => $color)
                                <option value="{{ $estado }}"
                                    {{ $estado == $consulta->estado ? 'selected' : '' }}>
                                    {{ $estado }}
                                </option>
                            @endforeach
                        </select>

                        @if ($consulta->estado == 'Agendado')
                            <div class="">
                                {{-- {{ ($consulta->fecha < now()->format('Y-m-d') or $consulta->hora < now()->format('H:i:s')) ? 'bg-red-500' : 'bg-blue-400' }} --}}
                                <div
                                    class="group absolute rounded-full top-10 left-2 z-10 cursor-pointer text-sm                                             
                                    {{ $consulta->fecha > now()->format('Y-m-d') ? 'bg-blue-400' : ($consulta->hora < now()->format('H:i:s') ? 'bg-red-500' : 'bg-blue-400' ) }}
                                            p-1 overflow-hidden transition-all duration-300 w-7 h-7 hover:w-36 hover:h-20 hover:rounded-md">
                                    <div class="flex text-center object-center items-center justify-center">
                                        <p class="group-hover:hidden">
                                            <svg class="w-5 h-5 text-gray-800 " aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </p>
                                    </div>
                                    <div class="flex">
                                        <p
                                            class="hidden group-hover:block text-xs text-center object-center justify-between">
                                            <svg class="w-5 h-5 text-gray-800 " aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </p>
                                        <span class="pl-5 font-semibold">Detalles</span>
                                    </div>
                                    <p class="hidden group-hover:block mt-1 text-xs text-center object-center">
                                        Fecha: {{ \Carbon\Carbon::parse($consulta->fecha)->format('d-m-Y') }}
                                    </p>
                                    <p class="hidden group-hover:block mt-1 text-xs text-center object-center">
                                        Hora: {{ \Carbon\Carbon::parse($consulta->hora)->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Botón de actualizacion -->
                        <div class="flex flex-col">
                            <div class="group">
                                <button wire:click="openModalConfig({{ $consulta->id }})"
                                    class=" bg-gray-200 cursor-pointer absolute top-2 right-2 z-10 p-1  rounded-full 
                                        hover:bg-opacity-40 transition-all duration-200 focus:outline-none">
                                    <svg class="w-6 h-6 text-gray-600 transition duration-300 group-hover:rotate-45 group-hover:text-gray-800"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
                                    </svg>
                                </button>
                            </div>

                            <!-- icono para enviar a caja-->
                            @php
                                $pagoEstados = [
                                    'pendiente' => 'bg-orange-400',
                                    'parcial' => 'bg-yellow-400',
                                    'pagado' => 'bg-green-500',
                                    'cancelado' => 'bg-red-500',
                                ];

                                $pago = $pagos->where('consulta_id', $consulta->id)->first();
                            @endphp
                            @if ($pago)
                                @foreach ($pagoEstados as $estado => $bg)
                                    <!-- icono de pagado (el verde) -->
                                    <div class="group">
                                        <a @if ($pago->estado == 'pagado') href="" @else href="{{ route('caja.store', ['consultaId' => $consulta->id]) }}" @endif
                                            class="{{ $estado == $pago->estado ? "$bg" : '' }} cursor-pointer absolute top-12 right-2 z-10 p-1 rounded-full ">
                                            @if ($pago->estado == 'pagado')
                                                <svg class="w-6 h-6 text-white transition duration-300 group-hover:scale-140"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M5 11.917 9.724 16.5 19 7.5" />
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 text-gray-600 transition duration-300 group-hover:scale-140"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M4 19v2c0 .5523.44772 1 1 1h14c.5523 0 1-.4477 1-1v-2H4Z" />
                                                    <path fill="currentColor" fill-rule="evenodd"
                                                        d="M9 3c0-.55228.44772-1 1-1h8c.5523 0 1 .44772 1 1v3c0 .55228-.4477 1-1 1h-2v1h2c.5096 0 .9376.38314.9939.88957L19.8951 17H4.10498l.90116-8.11043C5.06241 8.38314 5.49047 8 6.00002 8H12V7h-2c-.55228 0-1-.44772-1-1V3Zm1.01 8H8.00002v2.01H10.01V11Zm.99 0h2.01v2.01H11V11Zm5.01 0H14v2.01h2.01V11Zm-8.00998 3H10.01v2.01H8.00002V14ZM13.01 14H11v2.01h2.01V14Zm.99 0h2.01v2.01H14V14ZM11 4h6v1h-6V4Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <!-- icono de la caja -->
                                <div class="group">
                                    <a href="{{ route('caja.store', ['consultaId' => $consulta->id]) }}"
                                        class="bg-gray-200 cursor-pointer absolute top-12 right-2 z-10 p-1  rounded-full">
                                        <svg class="w-6 h-6 text-gray-600 transition duration-300 group-hover:scale-115 group-hover:text-gray-800"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="none" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M4 19v2c0 .5523.44772 1 1 1h14c.5523 0 1-.4477 1-1v-2H4Z" />
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M9 3c0-.55228.44772-1 1-1h8c.5523 0 1 .44772 1 1v3c0 .55228-.4477 1-1 1h-2v1h2c.5096 0 .9376.38314.9939.88957L19.8951 17H4.10498l.90116-8.11043C5.06241 8.38314 5.49047 8 6.00002 8H12V7h-2c-.55228 0-1-.44772-1-1V3Zm1.01 8H8.00002v2.01H10.01V11Zm.99 0h2.01v2.01H11V11Zm5.01 0H14v2.01h2.01V11Zm-8.00998 3H10.01v2.01H8.00002V14ZM13.01 14H11v2.01h2.01V14Zm.99 0h2.01v2.01H14V14ZM11 4h6v1h-6V4Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                            <!-- end envio a caja -->
                        </div>

                        <div class="relative ">
                            @foreach ($mascotas as $mascota)
                                @if ($mascota->id == $consulta->mascota_id)
                                    <img class="rounded-t-lg w-full h-48 object-cover"
                                        src="{{ asset("uploads/mascotas/$mascota->foto") }}" alt="Grisho" />
                                @endif
                            @endforeach
                            <div class="absolute bottom-0 left-0 p-2 bg-gray-900/50 text-white text-xs rounded-br-lg">
                                {{ $consulta->mascota->especieN->nombre }} | {{ $consulta->mascota->raza }} |
                                {{ App\Helpers\Helper::edad($consulta->mascota->nacimiento) }} años
                            </div>
                        </div>
                        <div class="p-4 flex flex-col gap-2">
                            <div class="flex justify-between items-center">
                                <h2 class="text-lg font-semibold">{{ $consulta->mascota->nombre }} <span
                                        class="text-xs text-gray-600 font-normal">|
                                        {{ $consulta->mascota->genero }}</span></h2>
                                <span class="text-xs text-gray-500 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $consulta->mascota->dueno->nombre }}
                                </span>
                            </div>

                            <!-- TIPO DE CONSULTA -->
                            <div class="gap-4 text-gray-600 text-sm">
                                <div class="flex items-center gap-2">
                                    <!-- Icono -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                        <path
                                            d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                        <path
                                            d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                                    </svg>
                                    <!-- Texto -->
                                    <p class="font-semibold text-gray-700">
                                        {{ Str::upper($consulta->tipoConsulta->nombre) }}</p>
                                </div>
                            </div>
                            <!-- HISTOTIAL COMPLETO -->
                            <div class="flex justify-center">
                                <a wire:navigate href="{{ route('historial.completo', ['id' => $consulta->id]) }}"
                                    class="flex items-center gap-5 text-xs md:text-sm font-semibold px-4 py-2 
                                           bg-gradient-to-r from-blue-400 to-blue-500 
                                           hover:from-blue-600 hover:to-blue-700 
                                           text-white rounded-lg ">
                                    <span>Historial completo</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                            <p class="text-xs text-gray-500">Código: {{ $consulta->codigo }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
    </main>

    @if ($addConsulta)
        @include('includes.consultas.modalAdd')
    @endif

    @if ($modalConfig)
        @include('includes.consultas.modalConfig')
    @endif

    @if ($tipoConsulta)
        @include('includes.consultas.modalTipoConsulta')
    @endif

    @if ($mascotasBusqueda)
        @include('includes.consultas.mascotas')
    @endif

    <script>
        function cambiarColor(select) {
            let colores = @json($estados);
            select.className =
                "estado-select absolute top-2 left-2 z-10 px-4 py-2 text-xs font-semibold text-white rounded-lg bg-gradient-to-r " +
                (colores[select.value] || "from-gray-300 to-gray-400 hover:from-gray-400 hover:to-gray-500");
        }

        function cambiarColorCard(id, estado) {
            let coloresf = @json($estadosf);
            let card = document.getElementById(`consulta-${id}`);

            if (card) {
                card.className =
                    `max-w-[270px] shadow-md rounded-lg overflow-hidden transition-all duration-200 
                          hover:scale-101 hover:shadow-lg relative ${coloresf[estado] || 'bg-gray-300 border-gray-400'}`;
            }
        }
    </script>
</div>
