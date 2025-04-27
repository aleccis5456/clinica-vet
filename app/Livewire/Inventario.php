<?php

namespace App\Livewire;

use App\Models\Proveedor;
use App\Models\MovimientoProduct;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


#[Title('Inventario')]
class Inventario extends Component {
    public $productoToEdit = '';
    public string $productoId = '';
    public string $categoria = '';
    public string $search = '';
    public int $verTodo = 9;
    public string $nombreP = '';
    public ?int $telefonoP;
    public ?string $direccionP;
    public ?string $email;
    public ?string $ruc;
    public int $cantidad = 1;
    public string $unidades = '';
    public int $precioInterno = 0;
    
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
        if(empty(session('modulos')['inventario'])){
            return redirect('/');
        }
        $this->productos = Producto::where('owner_id', $this->ownerId())->get();
        $this->categorias = Categoria::where('owner_id', $this->ownerId())->get();
        $this->proveedores = Proveedor::where('owner_id', $this->ownerId())->get();      
    }

    /**
     * 
     */
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

    /**
     * 
     */
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
            ]);
    
            $this->proveedores = Proveedor::create([
                'nombre' => $this->nombreP,
                'telefono' => $this->telefonoP ?? null,
                'direccion' => $this->direccionP ?? null,
                'email' => $this->email ?? null,
                'ruc' => $this->ruc ?? null,  
                'owner_id' => $this->ownerId(),
            ]);
        }catch(\Exception $e){
            DB::commit();
            return redirect()->route('inventario')->with('error', 'Error al agregar el proveedor '. $e->getMessage());
        }
        $this->modalProveedor = false;        
        return redirect()->route('inventario')->with('agregado', 'Proveedor agregado correctamente');            
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
        $this->detalleProducto = Producto::where('id', $productoId)
                                         ->where('owner_id', $this->ownerId())
                                         ->first();
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
        $this->productoToEdit = Producto::where('id', $productoId)
                                        ->where('owner_id', $this->ownerId())
                                        ->first();
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
            'nombre' => $this->categoria,
            'owner_id' => $this->ownerId(),
        ]);

        $this->categoria = '';
        $this->closeModalCategoria();
        return redirect()->route('inventario')->with('agregado', 'Categoria agregada correctamente');        
    }   

    public function deleteProducto(){
        try{
            Producto::where('id', $this->productoId)
                    ->where('owner_id', $this->ownerId())
                    ->delete();
        }catch(\Exception $e){
            DB::commit();
            throw new \Exception($e->getMessage());
        }
        return redirect()->route('inventario')->with('eliminado', 'Producto eliminado correctamente');
    }

    public function eliminarCategoria($categoriaId){
        try{
            Categoria::where('id', $categoriaId)
                      ->where('owner_id', $this->ownerId())
                      ->delete();
        }catch(\Exception $e){
            DB::commit();
            throw new \Exception($e->getMessage());
        }
        return redirect()->route('inventario')->with('eliminado', 'Categoria eliminada correctamente');

    }

    public function render() : \Illuminate\View\View{
        return view('livewire.inventario');
    }
}
