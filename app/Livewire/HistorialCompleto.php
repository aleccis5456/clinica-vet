<?php

namespace App\Livewire;

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

    public function mount($id){
        $this->consultaId = $id;

        $this->consulta = Consulta::find($this->consultaId);        
        $this->mascota = Mascota::find($this->consulta->mascota_id);
    }

    public function render()
    {           
        return view('livewire.historial-completo');
    }
}
