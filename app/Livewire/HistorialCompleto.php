<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\ConsultaProducto;
use App\Models\ConsultaVeterinario;
use App\Models\Mascota;
use App\Models\Consulta;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Historial Completo')]
class HistorialCompleto extends Component
{
    public $consultaId;
    public $consulta;
    public $mascota;     
    public $consultas;
    public $cantidad;
    public $consultaVeterinario;
    public $flag = false;
    public $productos;
    public $fecha;


    public function flagTrue(){
        $this->flag = true;
    }
    public function flagFalse(){
        $this->flag = false;
        $this->mount($this->consultaId);
    }

    public function filtro($consultaId){        
        $this->flagTrue();
        $this->productos = ConsultaProducto::where('consulta_id', $consultaId)->get();
        $this->consultas = Consulta::find($consultaId);     
        $this->consulta = Consulta::find($consultaId);
        $this->consultas = $this->consultas ? collect([$this->consultas]) : collect();        
    }    

    public function mount($id){        
        Helper::check();
        $this->consultaId = $id;
        $this->consulta = Consulta::find($this->consultaId);        
        $this->mascota = Mascota::find($this->consulta->mascota_id);              
        $this->consultas = Consulta::where('mascota_id', $this->mascota->id)->get();
        $this->cantidad = Consulta::where('mascota_id', $this->mascota->id)->get();
        $this->consultaVeterinario = ConsultaVeterinario::where('consulta_id', $this->consultaId)->get();
        $this->fecha = Consulta::orderBy('id', 'desc')->first();

        if(empty(session('modulos')['consulta'])){
            return redirect('/');
        }
    }

    public function render()
    {           
        return view('livewire.historial-completo');
    }
}
