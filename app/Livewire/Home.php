<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\Producto;
use App\Models\ConsultaProducto;
use App\Models\Pago;
use App\Models\Consulta;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

#[Title('Inicio')]
class Home extends Component
{
    public $modal = false;
    public $register = false;    

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
        $this->redirect('/');
    }

    public function mount(){
        Helper::check();
        Helper::crearCajas();       
    }

    public function render()
    {
        return view('livewire.home');
    }
}
