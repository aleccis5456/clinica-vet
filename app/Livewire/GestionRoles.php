<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Gestion de usuarios')]
class GestionRoles extends Component
{
    public $modalRol = false;
    public $modalRegistro = false;
    public $tablaRoles = false;

    /**
     * 
     */
    public function openTablaRoles(){
        $this->tablaRoles = true;
    }
    public function closeTablaRoles(){
        $this->tablaRoles = false;
    }

    /**
     * 
     */
    public function openModalRol(){
        $this->modalRol = true;
    }
    public function closeModalRol(){
        $this->modalRol = false;
    }

    /**
     * 
     */
    public function openModalRegistro(){
        $this->modalRegistro = true;
    }
    public function closeModalRegistro(){
        $this->modalRegistro = false;
    }


    public function render()
    {
        return view('livewire.gestion-roles');
    }
}
