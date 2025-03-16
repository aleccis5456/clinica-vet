<?php

namespace App\Livewire;

use App\Models\Dueno;
use App\Models\DatosFactura;
use App\Models\TipoConsulta;
use App\Models\Producto;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Caja')]
class Caja extends Component
{
    public $search = '';
    public $producto;
    public $tablaProductos = false;
    public $tiposConsultas;
    public $productos;
    public $alertas = true;
    public $opcion = "1";
    public $duenos;
    public $nombreRS = '';
    public $rucCI = '';
    public $resultados = false;
    public $clientes;
    public $clientesf;
    public $clienteCheck;
    public $registro = false;
    public $rNombre;
    public $rRuc;
    public $tablaClientes = false;

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

    public function tablaTrue()
    {
        $this->tablaProductos = true;
    }
    public function tablaFalse()
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
    public function cobro($id, $index = null)
    {
        $cobro = session('cobro', []);
        if (session('cobro')) {
            if ($index != null) {
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
                'productoId' => $producto->id,
                'precio' => $producto->precio,
                'producto' => $producto->nombre,
                'cantidad' => 1,
                'opcion' => $this->opcion,
                'productoCompleto' => $producto,
            ];
        }

        session(['cobro' => $cobro]);
    }

    /**
     * function que muestra clientes en el modal
     */
    public function nombreFactura()
    {
        if (!empty($this->nombreRS)) {
            $filtro = $this->nombreRS;
        } else {
            $filtro = (int)$this->rucCI;
        }        
        if(empty($this->nombreRS) and empty($this->rucCI)){
            dd('si?');
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
    public function disminuir($index){
        $cobro = session('cobro');
            
        if ($cobro[$index]['cantidad'] > 1) {
            $cobro[$index]['cantidad']--;
        } else {
            unset($cobro[$index]);
        }
        session(['cobro' => $cobro]);
    }


    public function quitar($indice)
    {
        $carrito = session('carrito');

        if ($carrito[$indice]['cantidad'] > 1) {
            $carrito[$indice]['cantidad']--;
        } else {
            unset($carrito[$indice]);
        }
        session(['carrito' => $carrito]);

        return back();
    }
    /**
     * función que autocompleta los datos del cliente 
     */
    public function select($cliente)
    {        
        $this->nombreRS = $cliente['nombre_rs'];
        $this->rucCI = $cliente['ruc_ci'];
        $this->resultadosFalse();
    }

    public function mount()
    {
        $this->duenos = Dueno::all();
    }

    public function render()
    {
        return view('livewire.caja');
    }
}
