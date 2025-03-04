<?php

namespace App\Livewire;

use App\Models\RolUser;
use App\Models\Rol;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

#[Title('Gestion de usuarios')]
class GestionRoles extends Component
{

    public $search = '';
    public $rolName = '';    
    public $name = '';
    public $email = '';
    public $password = '';
    public $rol = '';

    public $roles;
    public $users;
    public $rolUser;   
    public $rolesUsers;

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

    /**
     * 
     */
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


    public function eliminarRol($id){
        $rol = Rol::find($id);
        $rol->delete();
        return redirect('/Gestion/usuario')->with('eliminado', 'Rol eliminado con éxito');
    }

    /**
     * 
     */
    public function crearUsuario(){        
        try{
            $this->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'rol' => 'required|exists:roles,id'
            ]);
    
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'rol_id' => $this->rol
            ]);
    
            // RolUser::create([
            //     'user_id' => $user->id,
            //     'role_id' => $this->rol
            // ]);
        }catch(\Exception $e){
            return redirect('/Gestion/usuario')->with('error', $e->getMessage());
        }          
        
       
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->rol = '';
        $this->closeModalRegistro();
        return redirect('/Gestion/usuario')->with('agregado', 'Usuario creado con éxito');
    }
    public function render()
    {
        return view('livewire.gestion-roles');
    }
}
