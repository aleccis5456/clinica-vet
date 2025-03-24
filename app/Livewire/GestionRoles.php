<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\Consulta;
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

    public string $search = '';
    public string $rolName = '';    
    public string $name;
    public string $email;
    public string $password;
    public string $rol;
    public array $permisosRoles = [];

    public object $permisos;
    public object $roles;
    public object $users;
    public object $rolUser;   
    public object $rolesUsers;
    public object $rolToConf;    
    public object $permisosRolesObject;    
    public object $userToEdit;
    public string $userToDelete;

    public bool $modelPermisos = false;
    public bool $modalRol = false;
    public bool $modalRegistro = false;
    public bool $tablaRoles = false;
    public bool $configRoles = false;
    public bool $editUser = false;
    public bool $showPassword = false;
    public bool $eliminarUser = false;

    /**
     * 
     */
    public function mount(){
        Helper::check();
        $this->roles = Rol::all();
        $this->users = User::where('id', '!=', 1)->get();        
        $this->permisosRolesObject = PermisoRol::all();

        if(empty(session('modulos')['gestionUsuario'])){
            return redirect('/');
        }
    }

    /**
     * funciones para mostrar el modal de eliminar usuario
     */
    public function eliminarUserTrue($userId){          
        $this->userToDelete = $userId;
        $this->eliminarUser = true;
    }
    public function eliminarUserFalse(){
        $this->eliminarUser = false;
    }
    public function eliminar($userId){
        $user = User::find($userId);
        $consulta = Consulta::where('veterinario_id', $userId)->get();
        if(count($consulta) > 0){
            return redirect('/Gestion/usuario')->with('error', 'No se puede eliminar el usuario, tiene consultas asociadas');

        }
        
        $user->delete();
        return redirect('/Gestion/usuario')->with('eliminado', 'Usuario eliminado con éxito');
    }

    /**
     * 
     */
    public function showPasswordTrue(){
        $this->showPassword = true;
    }
    public function showPasswordFalse(){
        $this->showPassword = false;
    }

    /**
     * 
     */
    public function editUserTrue($userId){        
        $this->userToEdit = User::find($userId);
        $this->editUser = true;        
    }
    public function editUserFalse(){
        $this->editUser = false;
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
     * realmente no hace nada más que recargar la vista
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
