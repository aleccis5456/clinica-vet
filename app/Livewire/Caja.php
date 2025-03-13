<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Caja')]
class Caja extends Component
{    
    public $search = '';
    public $productos;
    public $tablaProductos = false;

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
            $this->tablaFalse();
        }else{
            $this->tablaTrue();
            $this->productos = Producto::whereLike('nombre', "%$this->search%")->get();
        }
    }

    public function flag(){
        $this->search = '';
        $this->tablaFalse();
    }

    public function render()
    {
        return view('livewire.caja');
    }
}