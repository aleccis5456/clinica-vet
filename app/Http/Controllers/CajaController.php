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
    public function store($consultaId) : mixed{
        
        $consulta = Consulta::find($consultaId); 

        if(!$consulta){
            return back()->with('error', 'Ocurrio un error');
        }
        $consultaProductos = ConsultaProducto::where('consulta_id', $consultaId)->get();
        
        $productos = [];

        foreach($consultaProductos as $cProducto){
            $producto = Producto::find($cProducto->producto_id);
                        
            $productos[] = [
                "productoId" => $producto->id,
                "producto" => $producto->nombre,
                "cantidad" => $cProducto->cantidad,                
                "precio" => $producto->precio,     
                "owner_id" => $this->ownerId(),  
            ];            
        }                                

        // $caja = session('caja', []);    
        $caja = Caja::where('owner_id', $this->ownerId())
                    ->where('consulta_id', $consultaId)
                    ->first();
        if($caja){
            return back()->with('error', 'Esta consulta ya se envió a caja');
        }

        $productoConsulta = ConsultaProducto::where('owner_id', $this->ownerId())
                        ->where('consulta_id', $consultaId)
                        ->first();

        $totalConsulta = $consulta->tipoConsulta->precio;
        $totalProductos = 0;        
        foreach($productos as $producto){                  
            $totalProductos += (int)$producto['cantidad']*(int)$producto['precio'];
        }
        $total = $totalConsulta + $totalProductos;


        $pago = Pago::create([
            'dueno_id' => $consulta->mascota->dueno->id,
            'consulta_id' => $consulta->id,
            'monto' => $total,
            'pagado' => false,
            'cuotas' => false,
            'estado' => 'pendiente',
            'owner_id' => $this->ownerId(),
        ]);
        
        Caja::create([
            'consulta_id' => $consultaId,
            'dueno_id' => $consulta->mascota->dueno->id,
            'mascota_id' => $consulta->mascota->id,
            'pago_estado' => $pago->estado,
            'monto_total' => $total,
            'owner_id' => $this->ownerId(),
            'producto_consulta_id' => $productoConsulta ? $productoConsulta->id : null,
        ]);
        $consulta->update([
            'estado' => 'Pendiente'
        ]);
        // session(['caja' => $caja]);
        
        return redirect()->back()->with('caja_creada', 'Se ha creado una nueva caja.');
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
