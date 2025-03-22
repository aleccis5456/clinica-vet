<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\Consulta;
use App\Models\Pago;
use App\Models\Dueno;
use App\Models\DatosFactura;
use App\Models\TipoConsulta;
use App\Models\Producto;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

#[Title('Caja')]
class Caja extends Component
{
    public string $search = '';
    public $producto;
    public bool $tablaProductos = false;
    public $tiposConsultas;
    public object $productos;
    public bool $alertas = true;
    public $opcion = "1";
    public $duenos;
    public $nombreRS = '';
    public $rucCI = '';
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
        $this->clientesf = DatosFactura::orderByDesc('id')->get();
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
            $cliente = DatosFactura::find($clienteId)?->delete();
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
        ], [
            'rNombre.required' => 'Tienes que agregar un nombre',
            'rRuc.required' => 'Tienes que agregar un numero de RUC o CI',
            'rRuc.unique' => 'El número de RUC o CI ya está registrado. Intente con otro'
        ]);

        try{
            DatosFactura::create([
                'nombre_rs' => $this->rNombre,
                'ruc_ci' => $this->rRuc
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
            $this->productos;
            $this->tiposConsultas;
            $this->tablaFalse();
        } else {
            $this->alertaFalse();
            $this->tablaTrue();
            if ($this->opcion == '1') {
                $this->productos = Producto::whereLike('nombre', "%$this->search%")->get();
            } else {
                $this->productos = TipoConsulta::whereLike('nombre', "%$this->search%")->get();
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
            $producto = Producto::find($id);
        } else {            
            $producto = TipoConsulta::find($id);            
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
                'precio' => $producto->precio,
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
               
        $consulta = Consulta::find($consultaId);                    
        $cliente = DatosFactura::where('ruc_ci', $this->rucCI)->first();
    
        if (!$cliente) {
            return redirect()->route('caja')->with('error', 'Cliente no encontrado.');
        }
                        
        try{            
            $pago = Pago::where('consulta_id', $consultaId)->first();
            if ($pago) {    
                $pago->update([
                    'forma_pago' => $this->formaPago,
                    'pagado' => true,
                    'cliente_id' => $cliente->id,
                    'estado' => 'pagado',
                ]);

                foreach($cobro as $item){
                    $producto = Producto::find($item['productoId']);
                    $producto->stock_actual -= $item['cantidad'];
                    $producto->save();
                }

            } else {            
                Pago::create([                                     
                    'monto' => Helper::total(),
                    'forma_pago' => $this->formaPago,
                    'pagado' => true,
                    'estado' => 'pagado',
                    'cliente_id' => $cliente->id,
                ]);

                foreach($cobro as $item){
                    $producto = Producto::find($item['productoId']);
                    $producto->stock_actual -= $item['cantidad'];
                    $producto->save();
                }

            }
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        
        Session::forget('caja');
        Session::forget('cobro');
        Session::forget('activo');
        Helper::crearCajas();
        return redirect()->route('caja')->with('pago', 'Pago confirmado.');
    }

    /**
     * funcion para cobrar las consultas que estan en las alertas
     */
    public function cobrarConsulta($consultaId) {
        $activo = session('activo', false);
        if($activo){
            return redirect()->route('caja')->with('error', 'Ya se agrego esta consulta');
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

    public function mount(){
        Helper::check();

        if(empty(session('modulos')['caja']['value'])){
            return redirect('/');
        }

        $this->duenos = Dueno::all();                   
    }    

    public function render()
    {
        return view('livewire.caja');
    }
}
