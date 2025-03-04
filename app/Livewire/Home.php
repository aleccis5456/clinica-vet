<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

#[Title('Home')]
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
    }

    public function render()
    {
        return view('livewire.home');
    }
}
