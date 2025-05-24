@php
    $pagoEstados = [
        'Pendiente' => 'bg-orange-200',
        'pagado' => 'bg-green-500',
    ];

    //$pago = $pagos->where('consulta_id', $consulta->id)->first();
    $caja = $cajas->where('consulta_id', $consulta->id)->first();
@endphp
@if ($caja)
    <div class="group">
        <a @if ($caja->pago_estado == 'pagado') href="" @else href="{{ route('caja.store', ['consultaId' => $consulta->id]) }}" @endif
            class="{{ $caja->pago_estado == 'pagado' ? 'bg-green-200' : 'bg-orange-200' }} cursor-pointer absolute top-12 right-2 z-10 p-1 rounded-full ">
            @if ($caja->pago_estado == 'pagado')
                <!-- icono de pagado (el verde) -->
                <svg class="w-6 h-6 text-white transition duration-300 group-hover:scale-115" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 11.917 9.724 16.5 19 7.5" />
                </svg>
            @else
                <!-- icono de pendiente (el naranja) -->
                <svg class="w-6 h-6 text-orange-500 transition duration-300 group-hover:scale-115" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M4 19v2c0 .5523.44772 1 1 1h14c.5523 0 1-.4477 1-1v-2H4Z" />
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M9 3c0-.55228.44772-1 1-1h8c.5523 0 1 .44772 1 1v3c0 .55228-.4477 1-1 1h-2v1h2c.5096 0 .9376.38314.9939.88957L19.8951 17H4.10498l.90116-8.11043C5.06241 8.38314 5.49047 8 6.00002 8H12V7h-2c-.55228 0-1-.44772-1-1V3Zm1.01 8H8.00002v2.01H10.01V11Zm.99 0h2.01v2.01H11V11Zm5.01 0H14v2.01h2.01V11Zm-8.00998 3H10.01v2.01H8.00002V14ZM13.01 14H11v2.01h2.01V14Zm.99 0h2.01v2.01H14V14ZM11 4h6v1h-6V4Z"
                        clip-rule="evenodd" />
                </svg>

                <i
                    class="absolute opacity-0 transition-all min-w-[80px] duration-200 ease-in group-hover:opacity-100 group-hover:z-10 -top-2 right-9 -z-10 p-1 text-xs font-semibold text-orange-500 rounded-lg bg-orange-200">
                    Caja Creada
                </i>
            @endif
        </a>
    </div>
@else
    <!-- icono de la caja -->
    <div class="group">
        <a href="{{ route('caja.store', ['consultaId' => $consulta->id]) }}"
            class="bg-gray-200 cursor-pointer absolute top-12 right-2 z-10 p-1  rounded-full">
            <svg class="w-6 h-6 text-gray-600 transition duration-300 group-hover:scale-115 group-hover:text-gray-800"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                viewBox="0 0 24 24">
                <path fill="currentColor" d="M4 19v2c0 .5523.44772 1 1 1h14c.5523 0 1-.4477 1-1v-2H4Z" />
                <path fill="currentColor" fill-rule="evenodd"
                    d="M9 3c0-.55228.44772-1 1-1h8c.5523 0 1 .44772 1 1v3c0 .55228-.4477 1-1 1h-2v1h2c.5096 0 .9376.38314.9939.88957L19.8951 17H4.10498l.90116-8.11043C5.06241 8.38314 5.49047 8 6.00002 8H12V7h-2c-.55228 0-1-.44772-1-1V3Zm1.01 8H8.00002v2.01H10.01V11Zm.99 0h2.01v2.01H11V11Zm5.01 0H14v2.01h2.01V11Zm-8.00998 3H10.01v2.01H8.00002V14ZM13.01 14H11v2.01h2.01V14Zm.99 0h2.01v2.01H14V14ZM11 4h6v1h-6V4Z"
                    clip-rule="evenodd" />
            </svg>
        </a>
        <i
            class="absolute opacity-0 transition-all duration-200 ease-in group-hover:opacity-100 group-hover:z-10 top-10 right-11 -z-10 p-1 text-xs font-semibold text-gray-600 rounded-lg bg-gray-200">
            Crear Caja
        </i>
    </div>
@endif
