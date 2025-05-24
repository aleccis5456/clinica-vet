@php
    $caja = $cajas->where('consulta_id', $consulta->id)->first();
@endphp
@if ($caja)
    <div class="group">
        <a @if ($caja->pago_estado == 'pagado') href="" @else href="{{ route('caja.store', ['consultaId' => $consulta->id]) }}" @endif
            class="{{ $caja->pago_estado == 'pagado' ? 'bg-green-200' : 'bg-orange-200' }} cursor-pointer absolute top-12 right-2 z-10 p-1 rounded-full ">
            @if ($caja->pago_estado == 'pagado')
                <!-- icono de pagado (el verde) -->
                <svg class="w-6 h-6 text-green-600 transition duration-300 group-hover:scale-115" aria-hidden="true"
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

              

                <i wire:click='eliminarCaja({{ $caja->id }})'
                    class="absolute opacity-0 transition-all min-w-auto duration-200 ease-in group-hover:opacity-100 group-hover:z-10 top-0 right-9 -z-10 p-1 text-xs font-semibold text-red-500 rounded-lg bg-gray-200 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>

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
