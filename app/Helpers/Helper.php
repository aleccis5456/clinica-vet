<?php

namespace App\Helpers;

use App\Models\Consulta;
use App\Models\Producto;
use App\Models\ConsultaProducto;
use App\Models\Pago;
use Carbon\Carbon;

class Helper{    
    public static function formatearFecha($fecha){        
        return Carbon::parse($fecha)->format('d-m-Y');
    }   
    
    public static function formatearMonto($monto){
        return number_format(round($monto, -2), 0, ',', '.');
    }

    public static function edad($fecha){
        return Carbon::parse($fecha)->age;        
    }

    public static function total(){
        $total = 0;        
        $cobro = session('cobro');
        foreach($cobro as &$item){
            $total += $item['precio']*$item['cantidad'];
        }        
        return $total;
    }

    public static function crearCajas() : void {
        $pagos = Pago::all();       
        $caja = session('caja', []);
        $cortar = false;  
                
        foreach($pagos as $pago){            
            if($pago->pagado){
                continue;
            }
            foreach($caja as $item){            
                if($item['consultaId'] == $pago->consulta_id){
                    $cortar = true;
                }
            }             
            if($cortar){
                continue;
            }
            $consultaProductos = ConsultaProducto::where('consulta_id', $pago->consulta_id)->get();
            
            $productos = [];
    
            foreach($consultaProductos as $cProducto){
                $producto = Producto::find($cProducto->producto_id);
                            
                $productos[] = [
                    "productoId" => $producto->id,
                    "producto" => $producto->nombre,
                    "cantidad" => $cProducto->cantidad,                
                    "precio" => $producto->precio
                ];            
            }         

            $consulta = Consulta::find($pago->consulta_id);    

            $pagoSumar = 0;
            foreach($productos as $producto){
                $pagoSumar += $producto['precio'] * $producto['cantidad'];
            }
            $pagoSumar += $consulta->tipoConsulta->precio;
            $pago->monto = $pagoSumar;
            $pago->save();
                        
                                    
            $caja[] = [
                'consultaId' => $pago->consulta_id,
                'cliente' => $consulta->mascota->dueno,
                'mascota' => $consulta->mascota,
                'productos' => $productos,
                'consulta' => $consulta,
                'pagoEstado' => $pago->estado,
                'montoTotal' => $pagoSumar,
            ];
            session(['caja' => $caja]);            
        }
    }
}