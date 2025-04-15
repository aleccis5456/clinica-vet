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
                            
        if (count($consultas) != 0) {
            $this->consultas = Consulta::where('estado', 'Agendado')->where(function ($query) {
                $query->where('hora', '<', now()->format('H:i:s'))
                    ->orWhere('fecha', '<', now()->format('Y-m-d'));
            })->get();                        
            $this->mostrar = true;
        }
        //dd($this->consultas, $this->mostrar);
    }        
    public function render()
    {
        return view('livewire.alerta-agendados');
    }
}
