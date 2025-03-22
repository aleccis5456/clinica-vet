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

    public $gestionPaciente = [
        'id'  => 1,
        'value' => false,
    ];    
    public $consulta = [
        'id'  => 2,
        'value' => false,
    ];    
    public $caja = [
        'id'  => 3,
        'value' => false,   
    ];
    public $inventario = [
        'id'  => 4,
        'value' => false,   
    ];
    public $gestionUsuario = [
        'id'  => 5,
        'value' => false,
    ];    
    public $reportes = [
        'id'  => 6,
        'value' => false,  
    ];    
    public $alertas = [
        'id'  => 7,
        'value' => false,
    ];

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
            $user = Auth::user();   
            $permisos = Permiso::all();             
            Helper::checkRol($user->rol_id);            

            $permisosIds = session('permisos');
            
            foreach($permisosIds as $permisoId){
                if($permisoId == 1){
                    $this->gestionPaciente['value'] = true;
                }
                if($permisoId == 2){
                    $this->consulta['value'] = true;
                }
                if($permisoId == 3){
                    $this->caja['value'] = true;
                }
                if($permisoId == 4){
                    $this->inventario['value'] = true;
                }
                if($permisoId == 5){
                    $this->gestionUsuario['value'] = true;
                }   
                if($permisoId == 6){
                    $this->reportes['value'] = true;
                }
                if($permisoId == 7){
                    $this->alertas['value'] = true;
                }
            }
        }                        

        Helper::crearCajas();       
    }

    public function render()
    {
        return view('livewire.home');
    }
}
