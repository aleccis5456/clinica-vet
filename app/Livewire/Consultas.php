<?php

namespace App\Livewire;

use App\Models\Pago;
use App\Models\ConsultaProducto;
use App\Models\TipoConsulta;
use App\Models\Producto;
use App\Models\ConsultaVeterinario;
use App\Models\Consulta;
use App\Models\Rol;
use App\Models\User;
use App\Models\Mascota;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

#[Title('Consultas')]
class Consultas extends Component
{
    public $search = '';
    public $mascotas;
    public $veterinarios;
    public $users;
    public $mascota_id, $veterinario_id, $fecha, $tipo, $sintomas, $diagnostico, $tratamiento, $notas, $hora, $estado;
    public $fechaN, $horaN;
    public $consultas;
    public $cambiarVet = false;
    public $vetChanged = '';
    public $addConsulta = false;
    public $modalConfig = false;
    public $consultaToEdit;
    public $message = false;
    public $cambiarVetId = '';
    public $productos;
    public $tipoConsulta = false;
    public $nombre, $descripcion, $precio;
    public $tipoConsultas;
    public $tablaTipoConsulta = false;
    public $tablaDeProductos = false;
    public $productoConsumido;
    public $q;
    public $consultasProductos;
    public $veterinariosAgg = [];
    public $modalProductoConsulta = false;
    public $cpId;
    public $flagDiagnostico, $flagSintomas, $flagTratamiento, $flagNotas;
    public $grupoVet;
    public $pagos;


    /**
     * function para la busqueda
     */
    public function busqueda(){        
        if(empty($this->search)){
            $this->consultas = Consulta::orderBy('id', 'desc')->take(12)->get();
        }else{
            $mascotas = Mascota::whereLike('nombre', "%$this->search%")->pluck('id');
            $this->consultas = Consulta::whereIn('mascota_id', $mascotas)->get();
        }
    }    
    public function flagC(){
        $this->search = '';
        $this->consultas = Consulta::orderBy('id', 'desc')->take(12)->get();
    }

    /**
     * function para elimiar un veterinario del grupo
     */
    public function eliminarVetGrupo($vetId){
        try{
            $vet = ConsultaVeterinario::find($vetId)?->delete();
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

        return redirect()->route('consultas')->with('eliminado', 'Veterinario eliminado del grupo');
    }

    /**
     * 
     */
    public function vaciarVariables()
    {
        $this->mascota_id = null;
        $this->veterinario_id = null;
        $this->fecha = null;
        $this->tipo = '';
        $this->sintomas = '';
        $this->diagnostico = '';
        $this->tratamiento = '';
        $this->notas = '';
        $this->hora = null;
        $this->estado = null;
    }

    /**
     * 
     */
    public function openProductoConsulta($cpId)
    {
        $this->cpId = $cpId;
        $this->modalProductoConsulta = true;
    }
    public function closeProductoConsulta()
    {
        $this->modalProductoConsulta = false;
    }

    /**
     * comprueba que hay ningun array vacio 
     */
    public function comprobarSession()
    {
        $sessionConsumo = session('consumo', []);

        // Filtrar los valores vacíos
        $sessionConsumo = array_filter($sessionConsumo, function ($productos) {
            return !empty($productos);
        });

        if (empty($sessionConsumo)) {
            Session::forget('consumo');
        } else {
            session(['consumo' => $sessionConsumo]);
        }
    }


    /**
     * 
     */
    public function openProductoConsumido()
    {
        $this->productoConsumido = true;
    }
    public function closeProductoConsumido()
    {
        $this->productoConsumido = false;
    }

    /**
     * 
     */
    public function filtrarProductos()
    {
        $this->openProductoConsumido();
        if (empty($this->q)) {
            $this->productos = Producto::take(0)->get();
        } else {
            $this->openProductoConsumido();
            $this->productos = Producto::whereLike('nombre', "%$this->q%")
                ->where('stock_actual', '>', 1)
                ->get();
        }
    }

    public function flag()
    {
        $this->q = '';        
    }

    /**
     * creacion de la sesion de productos
     */
    public function addProducto($productoId, $consultaId)
    {
        $producto = Producto::find($productoId);

        if (!$producto) {
            return redirect()->route('consultas')->with('error', 'Hubo un error al procesar el producto');
        }

        $consumo = session('consumo', []);

        if (!isset($consumo[$consultaId])) {
            $consumo[$consultaId] = [];
        }

        $contador = 0;

        foreach ($consumo[$consultaId] as &$item) {
            if ($item['productoId'] == $producto->id) {
                if ($item['productoCompleto']['precio'] == $item['precio']) {
                    $item['cantidad']++;
                    $contador++;
                    break;
                } else {
                    return back();
                }
            }
        }
        if ($contador == 0) {
            $consumo[$consultaId][] = [
                'consultaId' => $consultaId,
                'productoId' => $producto->id,
                'precio' => $producto->precio,
                'nombre' => $producto->nombre,
                'foto' => $producto->foto,
                'productoCompleto' => $producto,
                'cantidad' => 1 // Agregar clave 'cantidad'
            ];
        }

        // Guarda la sesión actualizada
        session(['consumo' => $consumo]);
    }

    /**
     * function que quita una unidad de la session consumos
     */
    public function quitarProducto($index, $consultaId)
    {
        $consumo = session('consumo', []);

        if (!isset($consumo[$consultaId][$index])) {
            return redirect()->route('consultas')->with('error', 'El producto no existe en la sesión');
        }

        if ($consumo[$consultaId][$index]['cantidad'] > 1) {
            $consumo[$consultaId][$index]['cantidad']--;
        } else {
            unset($consumo[$consultaId][$index]);
            session(['consumo' => $consumo]);
            //   return redirect()->route('consultas');
        }

        session(['consumo' => $consumo]); // Guardar la sesión después de modificar
    }


    /**
     * 
     */
    public function openTablaDeProducto()
    {
        $this->tablaDeProductos = true;
    }
    public function closeTablaDeProductos()
    {
        $this->tablaDeProductos = false;
    }

    /**
     * 
     */
    public function openTablaTipoConsulta()
    {
        $this->tablaTipoConsulta = true;
    }
    public function closeTablaTipoConsulta()
    {
        $this->tablaTipoConsulta = false;
    }


    /**
     * 
     */
    public function openTipoConsulta()
    {
        $this->tipoConsulta = true;
    }
    public function closeTipoConsulta()
    {
        $this->tipoConsulta = false;
    }
    public function crearTipoConsulta()
    {
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required',
        ]);

        try {
            TipoConsulta::create([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'precio' => $this->precio,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('consultas')->with('error', $e->getMessage());
        }

        return redirect()->route('consultas')->with('agregado', 'Tipo de consulta creado con éxito');
    }

    /**
     * 
     */
    public function openCambiarVet()
    {
        $this->cambiarVet = true;
    }
    public function closeCambiarVet()
    {
        $this->vetChanged = '';
        $this->cambiarVet = false;
    }
    public function setVetChanged($vetId)
    {
        $this->vetChanged = $vetId;
    }
    public function showMessage()
    {
        $this->message = true;
    }
    public function closeMessage()
    {
        $this->message = false;
    }


    /**
     * 
     */
    public function openModalConfig($consultaId)
    {
        $this->consultaToEdit = Consulta::find($consultaId);
        $this->horaN = $this->consultaToEdit->hora;
        $this->fechaN = $this->consultaToEdit->fecha;
        $this->tipo = $this->consultaToEdit->tipo_id;
        $this->notas = $this->consultaToEdit->notas;
        $this->sintomas = $this->consultaToEdit->sintomas;
        $this->diagnostico = $this->consultaToEdit->diagnostico;
        $this->tratamiento = $this->consultaToEdit->tratamiento;

        $this->consultasProductos = ConsultaProducto::where('consulta_id', $consultaId)->get();
        $this->modalConfig = true;
    }
    public function closeModalConfig()
    {
        Session::forget('consumo');
        $this->flag();
        $this->vetChanged = '';
        $this->consultaToEdit = null;
        $this->modalConfig = false;
    }

    /**
     * 
     */
    public function crearConsulta()
    {
        try {
            $this->validate([
                'mascota_id' => 'required',
                'veterinario_id' => 'required',
                'fecha' => 'required',
                'tipo' => 'required',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('consultas')->with('error', $e->getMessage());
        }

        try {
            foreach ($this->consultas as $consulta) {
                if ($consulta->mascota_id == $this->mascota_id) {
                    if ($consulta->estado != 'Finalizado' && $consulta->estado != 'Cancelado') {
                        return redirect()->route('consultas')->with('error', "Ya existe una consulta pendiente para esta mascota, Consulta Pendiente: $consulta->tipo" . " - " . "Fecha:  $consulta->fecha");
                    }
                }
            }

            if ($this->fecha != now()->format('Y-m-d') and $this->hora != now()->format('H:i')) {
                if ($this->hora < now()->format('H:i')) {
                    return redirect()->route('consultas')->with('error', 'La hora de la consulta no puede ser menor a la hora actual');
                } elseif ($this->fecha < now()->format('Y-m-d')) {
                    return redirect()->route('consultas')->with('error', 'La fecha de la consulta no puede ser menor a la fecha actual');
                }
                $this->estado = 'Agendado';
            }

            $consulta = Consulta::create([
                'mascota_id' => $this->mascota_id,
                'veterinario_id' => $this->veterinario_id,
                'fecha' => $this->fecha,
                'tipo_id' => $this->tipo,
                'sintomas' => $this->sintomas,
                'diagnostico' => $this->diagnostico,
                'tratamiento' => $this->tratamiento,
                'notas' => $this->notas,
                'hora' => $this->hora,
                'estado' => $this->estado ?? 'Pendiente',
            ]);
        
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return redirect()->route('consultas')->with('agregado', 'Consulta creada con éxito');
    }

    /**
     * 
     */
    public function opneAddConsulta()
    {
        $this->addConsulta = true;
    }
    public function closeAddConsulta()
    {
        $this->vetChanged = '';
        $this->addConsulta = false;
    }

    /**
     * funcion que actualiza el estado desde la vista principal de las consultas, <select>
     */
    public function updateEstado($consultaID, $estadoNuevo)
    {
        try {
            $consulta = Consulta::find($consultaID);
            $nombre = $consulta->mascota->nombre;
            foreach ($this->consultas as $consultaC) {
                if ($consultaC->mascota_id == $consulta->mascota_id) {
                    if ($consulta->estado == 'Finalizado' or $consulta->estdo == 'Cancelado' or $consulta->estdo == 'No asistió') {
                        if ($estadoNuevo != 'Finalizado' or $estadoNuevo != 'Cancelado' or $estadoNuevo != 'No asistió') {
                            return redirect()->route('consultas')->with('error', 'Ya existe una consulta activa para: ' . "$nombre");
                        }
                    }
                }
            }
            $consulta->estado = $estadoNuevo;
            $consulta->save();
        } catch (\Exception $e) {
            return redirect()->route('consultas')->with('error', $e->getMessage());
        }

        return redirect()->route('consultas')->with('editado', 'Estado de la consulta actualizado con éxito');
    }


    /**
     * funciton para cambiar veterinario
     */
    public function updateVet()
    {
        $this->validate([
            'cambiarVetId' => 'sometimes',
        ]);

        try {
            $consulta = Consulta::find($this->consultaToEdit->id);

            $consulta->update([
                'veterinario_id' => $this->cambiarVetId,
            ]);
            $consulta->save();

            ConsultaVeterinario::where('consulta_id', $consulta->id)->update([
                'veterinario_id' => $this->cambiarVetId,
            ]);

            return redirect()->route('consultas')->with('editado', 'Consulta actualizada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('consultas')->with('error', $e->getMessage());
        }
    }
    /**
     * formulario para editar la consulta (productos, tratamiento, sintomas, etc)
     */
    public function updateConsulta()
    {        
        $consumo = session('consumo', []);
        if (!empty($consumo)) {
            try {
                foreach ($consumo[$this->consultaToEdit->id] as $item) {
                    ConsultaProducto::create([
                        'producto_id' => $item['productoId'],
                        'consulta_id' => $item['consultaId'],
                        'cantidad' => $item['cantidad'],
                        'descripcion' => null,
                    ]);
                }
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
        $consulta = Consulta::find($this->consultaToEdit->id);

        $consulta->update([            
            'fecha' => $this->fechaN ?? $consulta->fecha,
            'tipo_id' => $this->tipo ?? $consulta->tipo_id,
            'sintomas' => $this->flagSintomas ? null : $this->sintomas,
            'diagnostico' => $this->flagDiagnostico ? null : $this->diagnostico,
            'tratamiento' => $this->flagTratamiento? null : $this->tratamiento,
            'notas' => $this->flagNotas ? null : $this->notas,                
            'hora' => $this->horaN ?? $consulta->hora,
            'estado' => $this->estado ?? $consulta->estado,
        ]);
        $consulta->save();

        if(!empty($this->veterinariosAgg)){           
            foreach($this->veterinariosAgg as $vetId){            
                ConsultaVeterinario::create([
                    'consulta_id' => $consulta->id,
                    'veterinario_id' => $vetId
                ]);            
            }
        }
        

        Session::forget('consumo');
        return redirect()->route('consultas')->with('agregado', 'Consulta Actualizada');
    }

    /**
     * function para eliminar una consultaProdcutos     
     */
    public function EliminarProductoConsulta($cpId)
    {
        try {
            $cp = ConsultaProducto::find($cpId)?->delete();
        } catch (\Exception $e) {
            return redirect()->route('consultas')->with('error', $e->getMessage());
        }
        $this->cpId = '';
        return redirect()->route('consultas')->with('eliminado', 'Producto eliminado de la consulta');
    }

    /**
     * 
     */
    public function mount()
    {
        //devuelve la lista de veterinarios. se muestra en la creacion de la consulta
        $rol = Rol::whereLike('name', "%vet%")->first();
        $vetId = $rol->id;
        $this->veterinarios = User::where('rol_id', $vetId)->get();

        //devuelve la lista de usuarios que no son veterinarios. se muestra en la creacion de la consulta
        $rol = Rol::whereNotLike('name', "%vet%")
            ->whereNotLike('name', "%user%")
            ->whereNotLike('name', "%admin%")
            ->WhereLike('name', "%pelu%")
            ->orWhereLike('name', "%este%")
            ->orWhereLike('name', "%tica%")
            ->first();
        $userId = $rol->id;
        $this->users = User::where('rol_id', $userId)->get();

        $this->vaciarVariables();

        //inicializa la fecha de la consulta. para que la fecha sea la actual automaticamente
        $this->fecha = now()->format('Y-m-d');
        //inicializa la hora de la consulta. para que la fecha sea la actual automaticamente
        $this->hora = now()->format('H:i');

        $this->mascotas = Mascota::all();
        $this->consultas = Consulta::orderBy('id', 'desc')->take(12)->get();
        $this->tipoConsultas = TipoConsulta::all();
        $this->grupoVet = ConsultaVeterinario::all();
        $this->pagos = Pago::all();

        $this->comprobarSession();
    }

    public function render()
    {
        return view('livewire.consultas');
    }
}
