<?php

namespace App\Http\Controllers;

use App\Models\MovimientoProduct;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportsController extends Controller
{
    public function exportarPdf(Request $request) {             
        $desde = $request->desde . ' 00:00:00' ?? now()->startOfDay();
        $hasta = $request->hasta . ' 23:59:59' ?? now()->endOfDay();
        $ventas = MovimientoProduct::join('productos', 'mivimiento_products.producto_id', '=', 'productos.id')                                       
                                        ->whereBetween('mivimiento_products.created_at', [$desde, $hasta])
                                        ->whereNotNull('mivimiento_products.producto_id')                                        
                                        ->orderBy('productos.ventas', 'desc')
                                        ->get();        

        $data = [
            'ventas' => $ventas,
            'title' => 'Reporte de Ventas',
            'desde' => $request->desde,
            'hasta' => $request->hasta
        ];            
        $pdf = Pdf::loadView('reportes.ventas', $data);        
        return $pdf->download('reporte_ventas.pdf');

    }
}
