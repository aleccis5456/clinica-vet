<?php

namespace App\Livewire;

use App\Models\MovimientoProduct;
use App\Models\Producto;
use App\Models\Especie;
use Livewire\Component;
use Carbon\Carbon;

class Reportes extends Component {
    public string $search = '';
    public object $especies;
    public object $productos;    
    public object $ventas;
    public bool $fechas = false;
    public string $desde = '';
    public string $hasta = '';   
    public bool $filtro = false;
    public string $filtroTag = '';

    /**
     * 
     */
    public function filtroTrue(){        
        $this->filtro = true;
        
    }
    public function filtroFalse(){
        $this->filtro = false;        
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

    public function mount() : void {
        $this->especies = Especie::all();     
        $this->productos = Producto::all();  
        $this->ventas = Producto::where('ventas', '!=', 0)
                                ->orderBy('ventas', 'desc')
                                ->get();
                                                                                                           
    }

    public function fechasTrue() : void {                   
        $this->fechas = true; 
           
            
    }
    public function fechasFalse() : void {
        $this->fechas = false;
        
    }
    
    public function filtrar(){                        
        if($this->search == ''){      
            $this->desde = empty($this->desde) ? now()->startOfDay()->format('Y-m-d H:s:i') : Carbon::parse($this->desde)->format('Y-m-d H:s:i'); 
            $this->hasta = empty($this->hasta) ? now()->endOfDay()->format('Y-m-d H:s:i') :  Carbon::parse($this->hasta)->format('Y-m-d H:s:i');
            
            $this->ventas = MovimientoProduct::join('productos', 'mivimiento_products.producto_id', '=', 'productos.id')
                                            ->whereNotNull('mivimiento_products.producto_id')
                                            ->whereBetween('mivimiento_products.created_at', [$this->desde, $this->hasta])    
                                            ->orderBy('productos.ventas', 'desc')
                                            ->get();
            $this->filtroTag = 'Fecha';
        }else{        
            $this->ventas = MovimientoProduct::join('productos', 'mivimiento_products.producto_id', '=', 'productos.id')
                                            ->whereNotNull('mivimiento_products.producto_id')                                            
                                            ->where('productos.nombre', 'like', '%'.$this->search.'%')                                           
                                            ->orderBy('productos.ventas', 'desc')
                                            ->get();
            $this->filtroTag = $this->search;
        }                
        $this->filtroFalse();
        
    }
  

    public function render() {
        return view('livewire.reportes');
    }
}
