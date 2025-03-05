<?php

namespace App\Livewire;

use App\Models\Mascota;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Consultas')]
class Consultas extends Component
{
    public $search = '';

    public $mascotas;
    
    public $addConsulta = false;

    /**
     * 
     */
    public function opneAddConsulta(){
        $this->addConsulta = true;
    }
    public function closeAddConsulta(){
        $this->addConsulta = false;
    }

    /**
     * 
     */
    public function mount(){        
        $this->mascotas = Mascota::all();
    }    
    public function render()
    {
        return view('livewire.consultas');
    }
}
