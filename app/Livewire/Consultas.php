<?php

namespace App\Livewire;

use App\Models\Mascota;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Consultas')]
class Consultas extends Component
{
    public $mascotas;

    public function mount(){
        $this->mascotas = Mascota::all();
    }

    public function render()
    {
        return view('livewire.consultas');
    }
}
