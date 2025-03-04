<?php

namespace App\Livewire;

use App\Models\Rol;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Gestion de usuarios')]
class GestionRoles extends Component
{

    public $rolName = '';

    public $roles;
    public $users;

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

    public function mount(){
        $this->roles = Rol::all();
        $this->users = User::all();
    }

    public function crearRol(){
        $this->validate([
            'rolName' => 'required'
        ]);

        Rol::create([
            'name' => $this->rolName
        ]);
       
        $this->rolName = '';
        $this->closeModalRol();
        return redirect('/Gestion/usuario')->with('agregado', 'Rol creado con éxito');
    }

    public function render()
    {
        return view('livewire.gestion-roles');
    }
}
