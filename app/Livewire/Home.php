<?php

namespace App\Livewire;

use App\Models\Permiso;
use App\Helpers\Helper;
use App\Models\Producto;
use App\Models\ConsultaProducto;
use App\Models\Pago;
use App\Models\Consulta;
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

    public function mount(){                           
        if(Auth::user()){
            Helper::checkRol(Auth::user()->rol_id);
            Helper::checkPermisos();
        }
        
        Helper::crearCajas();       
    }

    public function render()
    {
        return view('livewire.home');
    }
}
