<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\PermisoRol;
use App\Models\Permiso;
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
    public $permisosRoles = [];

    public $permisos;
    public $roles;
    public $users;
    public $rolUser;   
    public $rolesUsers;
    public $rolToConf;    
    public $permisosRolesObject;    

    public $modelPermisos = false;
    public $modalRol = false;
    public $modalRegistro = false;
    public $tablaRoles = false;
    public $configRoles = false;

    /**
     * 
     */
    public function mount(){
        Helper::check();
        $this->roles = Rol::all();
        $this->users = User::all();        
        $this->permisosRolesObject = PermisoRol::all();

        if(empty(session('modulos')['gestionUsuario']['value'])){
            return redirect('/');
        }
    }

    /**
     * funcion que establece los permisos, también funciona como un update
     */
    public function establecerPermisos(){                       
        $this->validate([
            'permisosRoles' => 'exists:permisos,id'
        ]);

        $permisosIds = PermisoRol::where('rol_id', $this->rolToConf->id)->pluck('rol_id')->toArray();

        foreach($permisosIds as $permisoId){
            PermisoRol::where('rol_id', $permisoId)->delete();
        }                                            
        try{
            foreach($this->permisosRoles as $permiso){                
                PermisoRol::create([
                    'rol_id' => $this->rolToConf->id,
                    'permiso_id' => $permiso
                ]);   
            }            
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }


        return redirect()->route('gestion.roles')->with('editado', 'Configuracion completada');
    }


    /**
     * fuincion para mostrar el div seleccionado en la vista modalCoigRole. lo unico que hace es recargar :D
     */
    public function setPermisos(){        
    }


    /**
     * 
     */
    public function configRolesTrue($rolToConf){        
        $this->rolToConf = Rol::find($rolToConf);
        
        $this->permisosRolesObject = PermisoRol::where('rol_id', $this->rolToConf->id)->get();
        $this->permisos = Permiso::all();
                
        if(count($this->permisosRolesObject) > 0){
            foreach($this->permisosRolesObject as $item){
                $this->permisosRoles[] = $item->permiso_id;
            }
        }

        $this->closeModalRol();
        $this->configRoles = true;
    }
    public function configRolesFalse(){      
        $this->permisosRoles = [];
        $this->configRoles = false;
        $this->openModalRol();
    }

    /**
     * 
     */
    public function openModelPermisos($rolToConf){
        $this->rolToConf = $rolToConf;
        $this->modelPermisos = true;
    }
    public function closeModelPermisos(){
        $this->modelPermisos = false;
    }
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
