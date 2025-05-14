<?php

namespace App\Livewire;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\MovimientoProduct;
use App\Models\Movimiento;
use App\Models\Consulta;
use App\Models\Pago;
use App\Models\Dueno;
use App\Models\DatosFactura;
use App\Models\TipoConsulta;
use App\Models\Producto;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

#[Title('Caja')]
class Caja extends Component
{
    public string $search = '';
    public $producto;
    public bool $tablaProductos = false;
    public $tiposConsultas;
    public ?object $productos;
    public bool $alertas = true;
    public $opcion = "1";
    public object $duenos;
    public string $nombreRS = '';
    public string $rucCI = '';
    public $resultados = false;
    public $clientes;
    public $clientesf;
    public $clienteCheck;
    public bool $registro = false;
    public string $rNombre;
    public string $rRuc;
    public bool $tablaClientes = false;    
    public int $total = 0;
    public bool $confirmar = false;
    public string $formaPago = ''; 
    
    public function mount()  {
        if(empty(session('modulos')['caja'])){
            return redirect('/');
        }
        Helper::check();
        $this->duenos = Dueno::all();                   
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

    public function confirmarTrue(){
        $this->validate([
            'nombreRS' => 'required',
            'rucCI' => 'required',
        ],[
            'nombreRS' => 'Selecciona un cliente',
            'rucCI' => 'Selecciona un cliente'
        ]);
        $this->confirmar = true;
    }
    public function confirmarFalse(){
        $this->confirmar = false;
    }

    public function tablaClientesTrue(){
        $this->clientesf = DatosFactura::where('owner_id', $this->ownerId())->orderByDesc('id')->get();
        $this->tablaClientes = true;
    }
    public function tablaClientesFalse(){
        $this->tablaClientes = False;
    }

    public function registroTrue(){
        $this->resultadosFalse();
        $this->registro = true;
    }
    public function registroFalse(){
        $this->registro = false;
    }

    public function resultadosTrue()
    {
        $this->resultados = true;
    }
    public function resultadosFalse()
    {
        $this->resultados = false;
    }

    public function alertaTrue()
    {
        $this->alertas = true;
    }
    public function alertaFalse()
    {
        $this->alertas = false;
    }

    public function tablaTrue() : void
    {
        $this->tablaProductos = true;
    }
    public function tablaFalse() : void
    {
        $this->tablaProductos = false;
    }

    public $estados = [
        'pendiente' => 'bg-orange-200',
        'parcial' => 'bg-yellow-200',
        'pagado' => 'bg-green-200',
        'cancelado' => 'bg-red-200'
    ];

    /**
     * funciton para eliminar un cliente 
     */
    public function eliminarCliente($clienteId){
        try{
            $cliente = DatosFactura::where('id', $clienteId)
                                    ->where('owner_id', $this->ownerId())
                                    ?->delete();
        }catch(\Exception $e){
            return redirect()->route('caja')->with('error', 'Ocurrió un error');
        }        
        return redirect()->route('caja')->with('eliminado', 'Eliminado correctamente');
    }

    /**
     * function para registrar clientes
     */
    public function registroCliente(){                 
        $this->validate([
            'rNombre' => 'required|string',
            'rRuc' => 'required|string|unique:datos_facturas,ruc_ci'
        ],[
            'rNombre.required' => 'Tienes que agregar un nombre',
            'rRuc.required' => 'Tienes que agregar un numero de RUC o CI',
            'rRuc.unique' => 'El número de RUC o CI ya está registrado. Intente con otro'
        ]);

        try{
            DatosFactura::create([
                'nombre_rs' => $this->rNombre,
                'ruc_ci' => $this->rRuc,
                'owner_id' => $this->ownerId(),
            ]);
        }catch(\Exception $e){
            return redirect()->route('caja')->with('error', $e->getMessage());
        }

        $this->nombreRS = $this->rNombre;
        $this->rucCI = $this->rRuc;
        $this->registroFalse();
    }

    /**
     * funcion para buscar productos o servicios
     */
    public function filtrar()
    {
        if (empty($this->search)) {            
            $this->tablaFalse();
        } else {
            $this->alertaFalse();
            $this->tablaTrue();
            if ($this->opcion == '1') {
                $this->productos = Producto::whereLike('nombre', "%$this->search%")
                                           ->where('stock_actual', '>', 0)
                                           ->where('owner_id', $this->ownerId())
                                            ->get();
            } else {
                $this->productos = TipoConsulta::whereLike('nombre', "%$this->search%")
                                                ->where('owner_id', $this->ownerId())
                                                ->get();
            }
        }        
    }

    public function flag()
    {
        $this->search = '';
        $this->alertaTrue();
        $this->tablaFalse();
    }

    /**
     * function para crear la session('cobro')
     */
    public function cobro($id, $index = null, $cantidad = null, $consultaId = null)
    {
        $cobro = session('cobro', []);                

        if(isset($consultaId)){
            foreach($cobro as $item){
                if($item['consultaId'] == $consultaId){
                    return redirect()->route('caja')->with('error', 'Ya se agrego esta consulta');
                }                            
            }                                    
        }                
        
        if (session('cobro')) {
            if (isset($index) || $index === 0) {                
                $this->opcion = $cobro[$index]['opcion'];
            }            
        }
        if ($this->opcion == '1') {
            $producto = Producto::where('id',$id)->where('stock_actual', '>', 0)
                                ->where('owner_id', $this->ownerId())
                                ->first();
        } else {            
            $producto = TipoConsulta::where('id', $id)
                                    ->where('owner_id', $this->ownerId())
                                    ->first();
                   
        }
        if (!$producto) {
            return redirect()->route('caja');
        }

        $contador = 0;
        foreach ($cobro as &$item) {
            if ($item['productoId'] == $id and $item['producto'] == $producto->nombre) {
                $contador++;
                $item['cantidad']++;
            }
        }
        unset($item);

        if ($contador == 0) {
            $cobro[] = [
                'consultaId' => $consultaId,
                'productoId' => $producto->id,
                'precio' => $producto->precio_interno ?? $producto->precio,
                'producto' => $producto->nombre,
                'cantidad' => $cantidad ?? 1,
                'opcion' => $this->opcion,
                'productoCompleto' => $producto,
            ];
        }

        session(['cobro' => $cobro]);        
    }

    /**
     * function que muestra clientes en el modal
     */
    public function nombreFactura() : void {
        if (!empty($this->nombreRS)) {
            $filtro = $this->nombreRS;
        } else {
            $filtro = (int)$this->rucCI;
        }        
        if(empty($this->nombreRS) and empty($this->rucCI)){            
            $this->clientes = [];
        }else{
            $this->clientes = DatosFactura::whereLike('nombre_rs', "%$filtro%")
                                        ->orWhereLike('ruc_ci', "%$filtro%")
                                        ->where('owner_id', $this->ownerId())
                                        ->get();
            $this->resultadosTrue();
        }        
    }

    /**
     * función para disminuir cantidad de un producto de la session cobro
     */
    public function disminuir($index) : void {
        $cobro = session('cobro');
            
        if ($cobro[$index]['cantidad'] > 1) {
            $cobro[$index]['cantidad']--;
        } else {
            unset($cobro[$index]);
        }
        session(['cobro' => $cobro]);
    }

    /**
     * función que autocompleta los datos del cliente 
     */
    public function select($cliente) : void {        
        $this->nombreRS = $cliente['nombre_rs'];
        $this->rucCI = $cliente['ruc_ci'];
        $this->resultadosFalse();
    }  

    /**
     * function para crear o actualizar un pago. actualizar un pago de una consulta 
     */
    public function confirmarPago(){
        $this->validate([
            'formaPago' => 'required'
        ],[
            'formaPago' => 'Selecciona un método de pago'
        ]);
        $cobro = session('cobro', []);
        $consultaId = null;        
        foreach ($cobro as $item) {
            if (isset($item['consultaId'])) {
                $consultaId = $item['consultaId'];
                break;
            }
        }            
        $cliente = DatosFactura::where('ruc_ci', $this->rucCI)
                                ->where('owner_id', $this->ownerId())
                                ->first();                          
        if (!$cliente) {
            return redirect()->route('caja')->with('error', 'Cliente no encontrado.');
        }        
        DB::beginTransaction();
        try{                                                             
            $pago = Pago::where('consulta_id', $consultaId)
                        ->where('pagado', false)
                        ->where('owner_id', $this->ownerId())
                        ->first();                        
            if ($pago) {    
                $pago->update([
                    'forma_pago' => $this->formaPago,
                    'pagado' => true,
                    'cliente_id' => $cliente->id,
                    'estado' => 'pagado',
                ]);              
            } else {                        
                Pago::create([                                     
                    'monto' => Helper::total(),
                    'forma_pago' => $this->formaPago,
                    'pagado' => true,
                    'estado' => 'pagado',
                    'dueno_id' => null,
                    'cliente_id' => $cliente->id,
                ]);                                                             
            }            
            $venta = Movimiento::create([
                'codigo' => $this->codigo(6),
                'monto' => Helper::total(),
                'cliente_id' => $cliente->id,                        
                'forma_pago' => $this->formaPago,
                'owner_id' => $this->ownerId(),
            ]);

            foreach($cobro as $item){                
                MovimientoProduct::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $item['opcion'] == '1' ? $item['productoId'] : null,
                    'consulta_id' => $item['opcion'] == '2' ? $item['productoId'] : null,                    
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                    'precio_total' => $item['precio'] * $item['cantidad'],
                    'owner_id' => $this->ownerId(),
                ]);                
                if($item['opcion'] == '1'){
                    $producto = Producto::find($item['productoId']);
                    $producto->stock_actual -= $item['cantidad'];
                    $producto->ventas += $item['cantidad'];
                    $producto->save();
                }
                if($item['opcion'] == '2'){                       
                    $tipo = TipoConsulta::find($item['productoId']);                                    

                    $tipo->veces_realizadas += 1;                    
                    $tipo->save();
                }                                                
            }
            $cajaDB = Helper::caja($this->ownerId(), $consultaId);
            if($cajaDB){
                $cajaDB->pago_estado = 'pagado';
                $cajaDB->save();
            }
            if($consultaId){
                $consulta = Consulta::where('id', $consultaId)
                                    ->where('owner_id', $this->ownerId())
                                    ->first();
                
                $consulta->update([
                                'estado' => 'Finalizado'
                            ]);
            }            
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
        Session::forget('caja');
        Session::forget('cobro');
        Session::forget('activo');
        Helper::crearCajas();
        return redirect()->route('caja')->with('pago', 'Pago confirmado.');
    }
    /**
     * funcion para cobrar las consultas que están en las alertas
     */
    public function cobrarConsulta($consultaId) {
        //dd('fds');
        $activo = session('activo', false);
        if($activo){
            $this->dispatch('error', 'Ya se agrego esta consulta');
        }
        $caja = session('caja', []);
        $cobro = session('cobro', []);                
        foreach($caja as $item){      
            if($item['consultaId'] == $consultaId){                
                foreach($item['productos'] as $producto){                
                    if(isset($producto['productoId'])){
                        $this->opcion = '1';
                        $this->cobro($producto['productoId'], $index=null, $producto['cantidad']);  
                    }
                };   
                      
                $this->opcion = '2';
                $this->cobro($item['consulta']['tipo_id'], $index=null, $cantidad=null, $item['consultaId']);   
                $this->opcion = '1';
            }                              
        }   
        session(['activo' => true]);
    }

    /**
     * 
     */
    public function borrarCobro() : void {
        Session::forget('cobro');
        Session::forget('activo');
    }

    private function codigo($length) : string {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }   

    public function render() {
        return view('livewire.caja');
    }
}
