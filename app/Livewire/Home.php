<?php

namespace App\Livewire;

use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

#[Title('Inicio')]
class Home extends Component
{
    public $modal = false;
    public $register = false;
    public $modalLogout = false;

    public function logoutModal(){
        $this->modalLogout = true;
    }
    public function closeLogoutModal(){
        $this->modalLogout = false;
    }

    public function openRegister(){
        $this->register = true;
    }
    public function closeRegister(){
        $this->register = false;
    }

    public function abrirModal()
    {
        $this->modal = true;
    }
    public function cerrarModal()
    {
        $this->modal = false;
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        $this->redirect('/');
    }

    public function ownerId(): mixed{
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
        return $admin_id;
    }

    public function mount(){                           
        if(Auth::user()){
            Helper::checkRol(Auth::user()->rol_id, $this->ownerId());
            Helper::checkPermisos();
        }
        
        Helper::crearCajas();       
    }

    public function render()
    {
        return view('livewire.home');
    }
}
