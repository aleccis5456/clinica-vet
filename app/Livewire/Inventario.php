<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Inventario')]
class Inventario extends Component
{
    public $productoToEdit = '';
    public $productoId = '';

    public $productos;

    public $modalAgregar = false;
    public $modalEditar = false;
    public $modalEliminar = false;


    public function openModalAgregar()
    {
        $this->modalAgregar = true;
    }
    public function closeModalAgregar(){
        $this->modalAgregar = false;
    }

    public function mount(){
        $this->productos = Producto::all();
    }
    

    public function render()
    {
        return view('livewire.inventario');
    }
}
