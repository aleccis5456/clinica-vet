<?php

namespace App\Livewire;

use App\Models\MovimientoProduct;
use App\Models\Producto;
use App\Models\Mascota;
use App\Models\Especie;
use Livewire\Component;

class Reportes extends Component {
    public object $especies;
    public object $productos;
    public object $movimientos;

    public function mount() {
        $this->especies = Especie::all();     
        $this->productos = Producto::all();
        //$this->movimientos = MovimientoProduct::where('producto_id', '!=', null)->groupBy('producto_id')->get();
    }

    public function render() {
        return view('livewire.reportes');
    }
}
