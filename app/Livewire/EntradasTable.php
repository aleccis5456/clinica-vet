<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DatosFactura;
use App\Models\Producto;
use App\Models\TipoConsulta;
use App\Models\Movimiento;
use App\Models\MovimientoProduct;
use Livewire\Component;
use Carbon\Carbon;

class EntradasTable extends Component
{
    public string $search = '';
    public string $desde = '';
    public string $hasta = '';
    public string $filtroTag = '';
    public ?object $ventas;
    public object $productos;
    public object $consultas;
    public object $movimientoP;

    public bool $fechas = false;
    public bool $filtro = false;
    public bool $pdf = false;

    /**
     * 
     */
    public function mount() : void {
        $this->ventas = Movimiento::orderBy('created_at', 'desc')
                                   ->where('owner_id', $this->ownerId())
                                    ->get();
        $this->movimientoP = MovimientoProduct::orderBy('created_at', 'desc')
                                    ->where('owner_id', $this->ownerId())
                                    ->get();
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
    /**
     * 
     */
    public function filtroTrue() : void {
        $this->filtro = true;
    }
    public function filtroFalse() : void {
        $this->filtro = false;
    }    
    
    /**
     * 
     */
    public function pdfTrue() : void {
        $this->pdf = true;
    }
    public function pdfFalse() : void {
        $this->pdf = false;
    }

    /**
     * 
     */
    public function filtrar(){                        
        if($this->search == ''){                  
            $desde = empty($this->desde) ? now()->startOfDay()->format('Y-m-d H:s:i') : Carbon::parse($this->desde)->startOfDay()->format('Y-m-d H:s:i'); 
            $hasta = empty($this->hasta) ? now()->endOfDay()->format('Y-m-d H:s:i') :  Carbon::parse($this->hasta)->endOfDay()->format('Y-m-d H:s:i');
                        
            $this->ventas = Movimiento::whereBetween('created_at', [$desde, $hasta])
                                        ->where('owner_id', $this->ownerId())
                                        ->get();
            $this->filtroTag = 'Fecha';
        }else{                    
            $productosIds = Producto::where('nombre', 'like', '%'.$this->search.'%')
                                        ->where('owner_id', $this->ownerId())
                                        ->pluck('id')
                                        ->toArray();
            $consultasIds = TipoConsulta::where('nombre', 'like', '%'.$this->search.'%')
                                            ->where('owner_id', $this->ownerId())
                                            ->pluck('id')
                                            ->toArray();            
            $clientesIds = DatosFactura::where('nombre_rs', 'like', '%'.$this->search.'%')
                                            ->where('owner_id', $this->ownerId())
                                            ->orWhere('ruc_ci', 'like', '%'.$this->search.'%')
                                            ->pluck('id')
                                            ->toArray();
            
            $movimientoP = MovimientoProduct::join('movimientos', 'mivimiento_products.venta_id', '=', 'movimientos.id')
                                                ->where('owner_id', $this->ownerId())
                                                ->whereIn('mivimiento_products.producto_id', $productosIds)
                                                ->orWhereIn('mivimiento_products.consulta_id', $consultasIds)
                                                ->orWhereIn('movimientos.cliente_id', $clientesIds)
                                                ->get();        

            $this->ventas = Movimiento::whereIn('id', $movimientoP->pluck('venta_id'))
                                        ->where('owner_id', $this->ownerId())
                                        ->get();
            

            $this->filtroTag = $this->search;
        }                
        $this->filtroFalse();        
    }

    public function refresh(): void{     
        $this->search = '';
        $this->desde = '';
        $this->hasta = '';
        $this->fechas = false;
        $this->filtroTag = '';
        $this->filtroFalse();
        $this->mount();   
    }
    
    public function render() {
        return view('livewire.entradas-table');
    }
}
