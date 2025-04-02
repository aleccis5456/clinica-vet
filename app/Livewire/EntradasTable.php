<?php

namespace App\Livewire;

use App\Models\Movimiento;
use App\Models\MovimientoProduct;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
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
    public bool $pdf = false;


    public function mount() : void {
        $this->ventas = Movimiento::orderBy('created_at', 'desc')->get();
        $this->movimientoP = MovimientoProduct::all();
    }
    
    public function pdfTrue() : void {
        $this->pdf = true;
    }
    public function pdfFalse() : void {
        $this->pdf = false;
    }
    
    public function render() {
        return view('livewire.entradas-table');
    }
}
