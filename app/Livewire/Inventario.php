<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Inventario')]
class Inventario extends Component
{
    public $productoToEdit = '';
    public $productoId = '';
    public $categoria = '';
    public $search = '';
    
    public $categorias;
    public $productos;

    public $modalAgregar = false;
    public $modalCategoria = false;
    public $modalEditar = false;
    public $modalEliminar = false;
    public $tableCategoria = false;

    /**
     * 
     */
    public function opneTableCategoria()
    {
        $this->tableCategoria = true;
    }   
    public function closeTableCategoria(){
        $this->tableCategoria = false;
    }

    /**
     * 
     */
    public function openModalAgregar()
    {
        $this->modalAgregar = true;
    }
    public function closeModalAgregar(){
        $this->modalAgregar = false;
    }

    /**
     * 
     */
    public function mount(){
        Helper::check();
        $this->productos = Producto::all();
        $this->categorias = Categoria::all();


        if(empty(session('modulos')['inventario']['value'])){
            return redirect('/');
        }
    }
    
    /**
     * 
     */
    public function openModalCategoria()
    {
        $this->modalCategoria = true;
    }
    public function closeModalCategoria(){
        $this->modalCategoria = false;
    }   

    /**
     * 
     */
    public function agregarCategoria()
    {
        $this->validate([
            'categoria' => 'required'
        ]);

        Categoria::create([
            'nombre' => $this->categoria
        ]);

        $this->categoria = '';
        $this->closeModalCategoria();
        return redirect()->route('inventario')->with('agregado', 'Categoria agregada correctamente');

        
    }   

    public function render()
    {
        return view('livewire.inventario');
    }
}
