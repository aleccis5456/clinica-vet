<?php

namespace App\Livewire;

use App\Models\Movimiento;
use App\Models\MovimientoProduct;
use App\Models\Producto;
use App\Models\TipoConsulta;
use App\Models\Especie;
use Livewire\Component;
use Carbon\Carbon;

class EntradasTable extends Component
{
    public string $search = '';
    public string $desde = '';
    public string $hasta = '';

    public ?object $ventas;
    public object $productos;
    public object $consultas;
    public object $movimientoP;

    public bool $fechas = false;
    public bool $filtro = false;
    
    public function mount() : void {
        $this->ventas = Movimiento::orderBy('created_at', 'desc')
                                            ->get();
        $this->movimientoP = MovimientoProduct::all();
    }

    public function render() {
        return view('livewire.entradas-table');
    }
}
