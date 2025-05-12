<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pago;
use App\Models\ConsultaProducto;
use App\Models\Producto;
use App\Models\Consulta;
use App\Models\Caja;
use App\Models\CajaProductos;

class CajaController extends Controller {
    public function store($consultaId) {
        $consulta = Consulta::where('id', $consultaId)->where('owner_id', $this->ownerId())->first();
    
        if(!$consulta){
            return back()->with('error', 'Ocurrió un error');
        }
        
        $consultaProductos = ConsultaProducto::where('consulta_id', $consultaId)
                                            ->where('owner_id', $this->ownerId())
                                            ->get();                                            
        if(!$consultaProductos){
            return back()->with('error', 'No se encontraron productos para esta consulta');
        }

        $cajadb = Caja::where('consulta_id', $consultaId)
                        ->where('owner_id', $this->ownerId())
                        ->where('pago_estado', 'Pendiente')
                        ->first();
        if($cajadb){
            return back()->with('error', 'Ya existe una caja pendiente para esta consulta');
        }
        $productos = [];
        $totalProductos = 0;
        foreach($consultaProductos as $consultaProducto){
            $productos[] = $consultaProducto->producto_id;
            $producto = Producto::where('id', $consultaProducto->producto_id)
                                ->where('owner_id', $this->ownerId())
                                ->first();                    
            $totalProductos += $consultaProducto->cantidad * (int)$producto->precio_interno;
        }
        $total = $totalProductos + $consulta->tipoConsulta->precio;

        

        Pago::create([
            'dueno_id' => $consulta->mascota->dueno_id, 	
            'consulta_id' => $consultaId, 	
            'monto' => $total, 	
            'forma_pago' => null, 	
            'notas' => null, 	
            'pagado' => false, 	
            'cuotas' => null, 	
            'cantidad_pagos' => null, 	
            'fecha_pago' => null, 	
            'fecha_vencimiento' => null,  	
            'estado' => 'Pendiente', 	
            'comprobante' => null,
            'cliente_id' ,
            'owner_id'
        ]);
        Caja::create([
            'consulta_id' => $consultaId,
            'dueno_id' => $consulta->mascota->dueno_id,
            'mascota_id' => $consulta->mascota_id,
            'owner_id' => $this->ownerId(),
            'pago_estado' => 'Pendiente',
            'monto_total' => $total,
            'productos' => $productos,
        ]);
        return back()->with('success', 'Caja creada con éxito');
    }

    public function ownerId(): mixed{
        $requestUserId = Auth::user()->id;
        $user = User::find($requestUserId);
        if($user->admin){
            $admin_id = $user->id;
        }else{
            $admin_id = $user->admin_id;
        }
        if($admin_id == null){
            return back()->with('error', 'No tienes permisos para agregar una mascota');
        } 
        return $admin_id;
    }
}
