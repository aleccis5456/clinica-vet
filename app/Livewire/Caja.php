<?php

namespace App\Livewire;

use App\Models\TipoConsulta;
use App\Models\Producto;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Caja')]
class Caja extends Component
{    
    public $search = '';
    public $producto;
    public $tablaProductos = false;
    public $tiposConsultas;
    public $productos;
    public $alertas = true;
    public $opcion = "1";

    public function alertaTrue(){
        $this->alertas = true;
    }
    public function alertaFalse(){
        $this->alertas = false;
    }

    public function tablaTrue(){
        $this->tablaProductos = true;
    }
    public function tablaFalse(){
        $this->tablaProductos = false;
    }

    public $estados = [
        'pendiente' => 'bg-orange-200',
        'parcial' => 'bg-yellow-200',
        'pagado' => 'bg-green-200',
        'cancelado' => 'bg-red-200'
    ];

    public function filtrar(){
        if(empty($this->search)){
            $this->productos;
            $this->tiposConsultas;
            $this->tablaFalse();
        }else{            
            $this->alertaFalse();
            $this->tablaTrue();                        
            if($this->opcion == '1'){                
                $this->productos = Producto::whereLike('nombre', "%$this->search%")->get();                        
            }else{                
                $this->productos = TipoConsulta::whereLike('nombre', "%$this->search%")->get();
            }
        }
        
    }

    public function flag(){
        $this->search = '';
        $this->alertaTrue();
        $this->tablaFalse();
    }

    public function render()
    {
        return view('livewire.caja');
    }
}
