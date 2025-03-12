<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\ConsultaProducto;
use App\Models\Producto;
use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CajaController extends Controller
{
    public function store($consultaId){
        $consulta = Consulta::find($consultaId); 

        if(!$consulta){
            return back()->with('error', 'Ocurrio un error');
        }

        $consultaProductos = ConsultaProducto::where('consulta_id', $consultaId)->get();
        
        $productos = [];

        foreach($consultaProductos as $cProducto){
            $producto = Producto::find($cProducto->producto_id);
                        
            $productos[] = [
                "producto" => $producto->nombre,
                "cantidad" => $cProducto->cantidad,                
                "precio" => $producto->precio
            ];            
        }                                

        $caja = session('caja', []);    

        foreach($caja as $item){            
            if($item['consultaId'] == $consultaId){
                return back()->with('error', 'Esta consulta ya se envio a caja');
            }
        }    
        
        $totalConsulta = $consulta->tipoConsulta->precio;
        $totalProductos = 0;        
        foreach($productos as $producto){                  
            $totalProductos += (int)$producto['cantidad']*(int)$producto['precio'];
        }
        $total = $totalConsulta + $totalProductos;
        
        $caja[] = [
            'consultaId' => $consultaId,
            'cliente' => $consulta->mascota->dueno->toArray(),
            'mascota' => $consulta->mascota->toArray(),
            'productos' => $productos,
            'consulta' => $consulta->toArray(),
            'montoTotal' => $total,
        ];

        session(['caja' => $caja]);

        $pago = Pago::create([
            'dueno_id' => $consulta->mascota->dueno->id,
            'consulta_id' => $consulta->id,
            'monto' => $total,
            'pagado' => false,
            'cuotas' => false,
        ]);
        
        return redirect()->back()->with('caja_creada', 'Se ha creado una nueva caja.');
    }
}
