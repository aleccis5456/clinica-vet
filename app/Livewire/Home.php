<?php

namespace App\Livewire;

use App\Models\Producto;
use App\Models\ConsultaProducto;
use App\Models\Pago;
use App\Models\Consulta;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

#[Title('Inicio')]
class Home extends Component
{
    public $modal = false;
    public $register = false;    

    public function openRegister(){
        $this->register = true;
    }
    public function closeRegister(){
        $this->register = false;
    }

    public function abrirModal()
    {
        $this->modal = true;
    }
    public function cerrarModal()
    {
        $this->modal = false;
    }

    public function logout(){
        Auth::logout();
        $this->redirect('/');
    }

    public function mount(){
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
                    "producto" => $producto->nombre,
                    "cantidad" => $cProducto->cantidad,                
                    "precio" => $producto->precio
                ];            
            }         

            $consulta = Consulta::find($pago->consulta_id);            

            $caja[] = [
                'consultaId' => $pago->consulta_id,
                'cliente' => $consulta->mascota->dueno,
                'mascota' => $consulta->mascota,
                'productos' => $productos,
                'consulta' => $consulta,
                'pagoEstado' => $pago->estado,
                'montoTotal' => $pago->monto,
            ];
            session(['caja' => $caja]);
        }
    }

    public function render()
    {
        return view('livewire.home');
    }
}
