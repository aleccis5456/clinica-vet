<div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $detalleProducto->nombre }}</h3>
    
    <div class="space-y-2">
        <div class="flex justify-between">
            <span class="text-gray-600 font-medium">Descripción:</span>
            <p class="text-gray-800 text-right max-w-[80%]">
                {!! nl2br(e($detalleProducto->descripcion)) !!}
            </p>
        </div>
        
        <div class="flex justify-between">
            <span class="text-gray-600 font-medium">Categoría:</span>
            <span class="text-gray-800">{{ $detalleProducto->categoria }}</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-600 font-medium">Precio de compra:</span>
            <span class="text-gray-800">{{ App\Helpers\Helper::formatearMonto($detalleProducto->precio_compra) }} Gs.</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-600 font-medium">Precio de venta:</span>
            <span class="text-gray-800 font-semibold text-lg">
                {{ App\Helpers\Helper::formatearMonto($detalleProducto->precio) }} Gs.
            </span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-600 font-medium">Stock disponible:</span>
            <span class="text-gray-800">{{ $detalleProducto->stock_actual }}</span>
        </div>

        <div class="flex justify-between border-t border-gray-200 pt-2 mt-2">
            <span class="text-gray-600 font-medium">Creado:</span>
            <span class="text-gray-500 text-sm">{{ $detalleProducto->created_at->format('d/m/Y') }}</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-600 font-medium">Última actualización:</span>
            <span class="text-gray-500 text-sm">{{ $detalleProducto->updated_at->format('d/m/Y H:i') }}</span>
        </div>
    </div>
</div>