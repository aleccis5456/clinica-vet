<?php

namespace App\Livewire;

use App\Models\Consulta;
use Livewire\Component;

class AlertaAgendados extends Component
{
    public $consultas;
    public $nombres= [];

    public function mount()
    {
        $this->consultas = Consulta::where('estado', 'Agendado')
            ->where(function ($query) {
                $query->where('hora', '<', now()->format('H:i:s'))
                    ->orWhere('fecha', '<', now()->format('Y-m-d'));
            })
            ->get();            
    }   

    public function render()
    {
        return view('livewire.alerta-agendados');
    }
}
