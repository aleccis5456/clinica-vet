<?php

namespace App\Livewire;

use App\Models\Consulta;
use Livewire\Component;

class AlertaAgendados extends Component {
    public $consultas;
    public $mostrar = false;

    public function mount(){
        $consultas = Consulta::where('estado', 'Agendado')
                            ->where('fecha', '<', now()->format('Y-m-d'))->get();                             

        if(count($consultas) != 0){
            $this->consultas = $consultas;
            $this->mostrar = true;
        } else {
            $this->consultas = [];
            $this->mostrar = false;

        }
    }        
    public function render()
    {
        return view('livewire.alerta-agendados');
    }
}
