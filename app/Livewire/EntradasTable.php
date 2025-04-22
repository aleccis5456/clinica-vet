<?php

namespace App\Livewire;

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
        $this->ventas = Movimiento::orderBy('created_at', 'desc')->get();
        $this->movimientoP = MovimientoProduct::all();
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
                        
            $this->ventas = Movimiento::whereBetween('created_at', [$desde, $hasta])->get();
            $this->filtroTag = 'Fecha';
        }else{                    
            $productosIds = Producto::where('nombre', 'like', '%'.$this->search.'%')
                                        ->pluck('id')
                                        ->toArray();
            $consultasIds = TipoConsulta::where('nombre', 'like', '%'.$this->search.'%')
                                            ->pluck('id')
                                            ->toArray();            
            $clientesIds = DatosFactura::where('nombre_rs', 'like', '%'.$this->search.'%')
                                            ->orWhere('ruc_ci', 'like', '%'.$this->search.'%')
                                            ->pluck('id')
                                            ->toArray();
            
            $movimientoP = MovimientoProduct::join('movimientos', 'mivimiento_products.venta_id', '=', 'movimientos.id')
                                                ->whereIn('mivimiento_products.producto_id', $productosIds)
                                                ->orWhereIn('mivimiento_products.consulta_id', $consultasIds)
                                                ->orWhereIn('movimientos.cliente_id', $clientesIds)
                                                ->get();        

            $this->ventas = Movimiento::whereIn('id', $movimientoP->pluck('venta_id'))->get();
            

            $this->filtroTag = $this->search;
        }                
        $this->filtroFalse();        
    }

    public function refresh(){     
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
