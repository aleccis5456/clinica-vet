<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use App\Helpers\Helper;
use App\Models\Consulta;
use App\Models\PermisoRol;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
    public string $requestUserId = '';

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
     * __construct
     */
    public function mount(){
        Helper::check();
        $this->roles = $this->getRoles();                 
        $this->users = $this->getUsers();
        $this->permisosRolesObject = PermisoRol::where('owner_id', Auth::user()->id)->get();
        
        if(empty(session('modulos')['gestionUsuario'])){
            return redirect('/');
        }
    }
    public function getRoles(){
        return Rol::where('id', '!=', 1)
                            ->where('owner_id', Auth::user()->id)
                            ->get();         
    }
    public function getUsers(){
        return User::where('admin', false)   
                            ->where('name', '!=', 'Sin Definir')                         
                            ->where('admin_id', Auth::user()->id)->get();        
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
        $requestUserId = Auth::user()->id;
        $user = User::find($requestUserId);
        if($user->admin){
            $admin_id = $user->id;
        }else{
            $admin_id = $user->admin_id;
        }
        if($admin_id == null){
            return back()->with('error', 'No tienes permisos para agregar una mascota');
        }                                  
                 
        try{
            foreach($this->permisosRoles as $permiso){                
                PermisoRol::create([
                    'rol_id' => $this->rolToConf->id,
                    'permiso_id' => $permiso,
                    'owner_id' => $admin_id,
                ]);   
            }            
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        $this->dispatch('success', 'Permisos asignados con éxito');
        //return redirect()->route('gestion.roles')->with('editado', 'Configuracion completada');
    }
    #[On('success')]
    public function success(){
        $this->roles = $this->getRoles();
        $this->users = $this->getUsers();
    }
    #[On('error')]
    public function error(){
     
    }

    /**
     * function para mostrar el div seleccionado en la vista modalCofigRole. 
     * lo único que hace es recargar :D     
     */
    public function setPermisos() :void {        
    }


    /**
     * 
     */
    public function configRolesTrue($rolToConf) :void {        
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

    public function configRolesFalse() :void {      
        $this->permisosRoles = [];
        $this->configRoles = false;
        $this->openModalRol();
    }

    /**
     * 
     */
    public function openModelPermisos($rolToConf) :void {
        $this->rolToConf = $rolToConf;
        $this->modelPermisos = true;
    }
    public function closeModelPermisos() :void {
        $this->modelPermisos = false;
    }
    /**
     * 
     */
    public function openTablaRoles() :void {
        $this->tablaRoles = true;
    }
    public function closeTablaRoles() :void {
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

    public function crearRol()  {
        
        $this->validate([
            'rolName' => 'required'
        ]);

        Rol::create([
            'name' => $this->rolName,
            'owner_id' => Auth::user()->id
        ]);
       
        $this->rolName = '';
        $this->closeModalRol();
        $this->dispatch('success', 'Rol creado con éxito');
    }


    public function eliminarRol($id){
        $rol = Rol::find($id);
        $rol->delete();
        $this->dispatch('success', 'Rol eliminado con éxito');
    }

    /**
     * 
     */
    public function crearUsuario() {        
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'rol' => 'required|exists:roles,id'
        ],[
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El email ya está en uso',
            'password.required' => 'La contraseña es requerida',
            'rol.required' => 'El rol es requerido',
            'rol.exists' => 'El rol no existe'
        ]);
                
        try{
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'admin' => false,
                'admin_id' => Auth::user()->id,
                'rol_id' => $this->rol
            ]);
    
        }catch(\Exception $e){
            $this->dispatch('error', 'Error al crear el usuario');
        }          
       
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->rol = '';
        $this->closeModalRegistro();
        $this->dispatch('success', 'Usuario creado con éxito');
    }
    
    public function render() {
        return view('livewire.gestion-roles');
    }
}
