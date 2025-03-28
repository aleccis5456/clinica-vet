<?php

namespace App\Livewire;

use App\Models\MovimientoProduct;
use App\Helpers\Helper;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Inventario')]
class Inventario extends Component
{
    public $productoToEdit = '';
    public $productoId = '';
    public $categoria = '';
    public string $search = '';
    public int $verTodo = 9;
    
    public object $categorias;
    public object $productos;    
    public object $detalleProducto;
    public object $ventas; //historial de ventas;

    public bool $modalAgregar = false;
    public bool $modalCategoria = false;
    public bool $modalEditar = false;
    public bool $modalEliminar = false;
    public bool $tableCategoria = false;
    public bool $editar = false;
    public bool $detalles = false;
    public bool $historial = false;

    /**
     * 
     */
    public function historialTrue(int $productoId): void {
        $this->ventas = MovimientoProduct::where('producto_id', $productoId)->get();        
        $this->detallesFalse();
        $this->historial = true;
    }
    public function historialFalse($productoId) : void {          
        $this->ventas;
        $this->detallesTrue($productoId);
        $this->historial = false;              
    }


    /**
     * 
     */
    public function detallesTrue($productoId) : void {
        $this->detalleProducto = Producto::find($productoId);
        $this->detalles = true;
    }
    public function detallesFalse() : void {
        $this->detalles = false;
        $this->detalleProducto;
    }

    /**
     * 
     */
    public function editarTrue($productoId) : void {        
        $this->productoToEdit = Producto::find($productoId);
        $this->editar = true;
    }
    public function editarFalse() : void {
        $this->editar = false;
    }

    /**
     * 
     */
    public function openVerTodo($productoId) : void {        
        $this->verTodo = 100;
        $this->productoId = $productoId;
    }
    public function closeVerTodo() : void {
        $this->verTodo = 9;
        $this->productoId = '';
    }

    /**
     * 
     */
    public function opneTableCategoria() : void {
        $this->tableCategoria = true;
    }   
    public function closeTableCategoria() : void{
        $this->tableCategoria = false;
    }

    /**
     * 
     */
    public function openModalAgregar() : void {
        $this->modalAgregar = true;
    }
    public function closeModalAgregar() : void {
        $this->modalAgregar = false;
    }

    /**
     * 
     */
    public function mount() {
        Helper::check();
        $this->productos = Producto::all();
        $this->categorias = Categoria::all();


        if(empty(session('modulos')['inventario'])){
            return redirect('/');
        }
    }
    
    /**
     * 
     */
    public function openModalCategoria() : void {
        $this->modalCategoria = true;
    }
    public function closeModalCategoria() : void {
        $this->modalCategoria = false;
    }   

    /**
     * 
     */
    public function agregarCategoria()  {
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

    public function render() : \Illuminate\View\View{
        return view('livewire.inventario');
    }
}
