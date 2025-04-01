<?php

namespace App\Livewire;

use App\Models\Proveedor;
use App\Models\MovimientoProduct;
use App\Helpers\Helper;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

#[Title('Inventario')]
class Inventario extends Component {
    public  $productoToEdit = '';
    public string $productoId = '';
    public string $categoria = '';
    public string $search = '';
    public int $verTodo = 9;
    public string $nombreP = '';
    public int $telefonoP;
    public string $direccionP = '';
    public string $email = '';
    public string $ruc = '';
    
    public object $categorias;
    public object $productos;    
    public object $detalleProducto;
    public object $ventas; //historial de ventas;
    public object $proveedores;

    public bool $modalAgregar = false;
    public bool $modalCategoria = false;
    public bool $modalEditar = false;
    public bool $modalEliminar = false;
    public bool $tableCategoria = false;
    public bool $editar = false;
    public bool $detalles = false;
    public bool $historial = false;
    public bool $modalProveedor = false;
    public bool $flagCodigo = false;
    public bool $alertaDelete = false;


    /**
     * 
     */
    public function mount() {
        Helper::check();
        $this->productos = Producto::all();
        $this->categorias = Categoria::all();
        $this->proveedores = Proveedor::all();

        if(empty(session('modulos')['inventario'])){
            return redirect('/');
        }
    }


    public function alertaTrue($productoId) : void {
        $this->productoId = $productoId;
        $this->alertaDelete = true;
    }
    public function alertaFalse() : void {
        $this->alertaDelete = false;
    }

    /*
     * 
     */
    public function proveedorTrue() : void {     
        $this->modalProveedor = true;
    }
    public function proveedorFalse() : void {
        $this->modalProveedor = false;
    }

    public function crearProveedor(){
        try{
            $this->validate([
                'nombreP' => 'required',
                'telefonoP' => 'numeric',
                'direccionP' => 'string',
                'email' => 'email',
                'ruc' => 'string'
            ]);
    
            $this->proveedores = Proveedor::create([
                'nombre' => $this->nombreP,
                'telefono' => $this->telefonoP,
                'direccion' => $this->direccionP,
                'email' => $this->email,
                'ruc' => $this->ruc
            ]);
        }catch(\Exception $e){
            DB::commit();
            throw new \Exception($e->getMessage());
        }
        return redirect()->route('inventario')->with('agregado', 'Proveedor agregado correctamente');            
        $this->modalProveedor = false;        
    }


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
    public function openModalCategoria() : void {
        $this->modalCategoria = true;
    }
    public function closeModalCategoria() : void {
        $this->modalCategoria = false;
    }   

    /**
     * 
     */
    public function agregarCategoria() {
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

    public function deleteProducto(){
        try{
            $producto = Producto::find($this->productoId)->delete();
        }catch(\Exception $e){
            DB::commit();
            throw new \Exception($e->getMessage());
        }
        return redirect()->route('inventario')->with('eliminado', 'Producto eliminado correctamente');
    }

    public function render() : \Illuminate\View\View{
        return view('livewire.inventario');
    }
}
