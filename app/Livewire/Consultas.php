<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\TipoConsulta;
use App\Models\Producto;
use App\Models\ConsultaVeterinario;
use App\Models\Consulta;
use App\Models\Rol;
use App\Models\User;
use App\Models\Mascota;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Consultas')]
class Consultas extends Component
{
    public $search = '';

    public $mascotas;
    public $veterinarios;
    public $users;
    public $mascota_id,	$veterinario_id, $fecha, $tipo, $sintomas, $diagnostico, $tratamiento, $notas, $hora, $estado;   
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
    public $cantidad = 1;

    /**
     * 
     */
    public function openProductoConsumido(){
        $this->productoConsumido = true;
    }
    public function closeProductoConsumido(){
        $this->productoConsumido = false;
    }

    /**
     * 
     */
    public function filtrarProductos(){        
        $this->openProductoConsumido();
        if(empty($this->q)){
            $this->productos = Producto::take(0)->get();
        }else{
            $this->openProductoConsumido();
            $this->productos = Producto::whereLike('nombre', "%$this->q%")->get();
        }
    }

    public function flag(){
        $this->q = '';        
    }

    public function addProducto($productoId)
    {        
        $producto = Producto::find($productoId);
        
        if (!$producto) {
            return redirect()->route('consultas')->with('error', 'Hubo un error al procesar el producto');
        }
    
        $consumo = session('consumo', []);
        $contador = 0;
    
        foreach ($consumo as &$item) {
            if ($item['productoId'] == $producto->id) {
                if ($item['productoCompleto']['precio'] == $item['precio']) {
                    $item['cantidad']++; // Incrementa la cantidad
                    $contador++;
                    break; // Sale del bucle porque ya se encontró el producto
                } else {
                    return back();
                }
            }
        }
    
        // Si no se encontró el producto en la sesión, lo agrega como nuevo
        if ($contador == 0) {
            $consumo[] = [
                'productoId' => $producto->id,
                'precio' => $producto->precio,
                'nombre' => $producto->nombre,
                'productoCompleto' => $producto,
                'cantidad' => 1 // Agregar clave 'cantidad'
            ];
        }
    
        // Guarda la sesión actualizada
        session(['consumo' => $consumo]);            
    }
    
    /**
     * 
     */    
    public function openTablaDeProducto(){
        $this->tablaDeProductos = true;
    }
    public function closeTablaDeProductos(){
        $this->tablaDeProductos = false;
    }

    /**
     * 
     */
    public function openTablaTipoConsulta(){
        $this->tablaTipoConsulta = true;
    }
    public function closeTablaTipoConsulta(){
        $this->tablaTipoConsulta = false;
    }


    /**
     * 
     */
    public function openTipoConsulta(){
        $this->tipoConsulta = true;
    }
    public function closeTipoConsulta(){
        $this->tipoConsulta = false;
    }       
    public function crearTipoConsulta(){
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required',
        ]);

        try{
            TipoConsulta::create([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'precio' => $this->precio,
            ]);
        }catch(\Exception $e){
            return redirect()->route('consultas')->with('error', $e->getMessage());
        }

        return redirect()->route('consultas')->with('agregado', 'Tipo de consulta creado con éxito');
    }

    /**
     * 
     */
    public function openCambiarVet(){        
        $this->cambiarVet = true;
    }
    public function closeCambiarVet(){        
        $this->vetChanged = '';
        $this->cambiarVet = false;
    }
    public function setVetChanged($vetId){
        $this->vetChanged = $vetId;
    }
    public function showMessage(){
        $this->message = true;
    }
    public function closeMessage(){
        $this->message = false;
    }
    

    /**
     * 
     */
    public function openModalConfig($consultaId){
        $this->consultaToEdit = Consulta::find($consultaId);
        
        $this->modalConfig = true;
    }
    public function closeModalConfig(){
        $this->vetChanged = '';
        $this->consultaToEdit = null;
        $this->modalConfig = false;
    }

    /**
     * 
     */
    public function crearConsulta(){        
        try{
            $this->validate([
                'mascota_id' => 'required',
                'veterinario_id' => 'required',
                'fecha' => 'required',
                'tipo' => 'required',                                             
            ]);
        }catch(\Exception $e){
            return redirect()->route('consultas')->with('error', $e->getMessage());
        }
            
        try{
            foreach($this->consultas as $consulta){                
                if($consulta->mascota_id == $this->mascota_id){
                    if($consulta->estado != 'Finalizado' or $consulta->estado != 'Cancelado'){
                        return redirect()->route('consultas')->with('error', "Ya existe una consulta pendiente para esta mascota, Consulta Pendiente: $consulta->tipo". " - ". "Fecha:  $consulta->fecha");
                    }               
                }
            }

            if($this->hora != now()->format('Y-m-d') or $this->hora != now()->format('H:i')){
                if($this->hora < now()->format('H:i')){
                    return redirect()->route('consultas')->with('error', 'La hora de la consulta no puede ser menor a la hora actual');
                }elseif($this->fecha < now()->format('Y-m-d')){
                    return redirect()->route('consultas')->with('error', 'La fecha de la consulta no puede ser menor a la fecha actual');
                }
                $this->estado = 'Agendado';
            }

            $consulta = Consulta::create([
                'mascota_id' => $this->mascota_id,
                'veterinario_id' => $this->veterinario_id,
                'fecha' => $this->fecha,
                'tipo' => $this->tipo,
                'sintomas' => $this->sintomas,
                'diagnostico' => $this->diagnostico,
                'tratamiento' => $this->tratamiento,
                'notas' => $this->notas,
                'estado' => 'pendiente',
                'hora' => $this->hora,
                'estado' => $this->estado ?? 'Pendiente',
            ]);

            ConsultaVeterinario::create([
                'consulta_id' => $consulta->id,
                'veterinario_id' => $this->veterinario_id,               
            ]);

        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
        return redirect()->route('consultas')->with('agregado', 'Consulta creada con éxito');            
    }

    /**
     * 
     */
    public function opneAddConsulta(){
        $this->addConsulta = true;
    }
    public function closeAddConsulta(){
        $this->vetChanged = '';
        $this->addConsulta = false;
    }

    /**
     * 
     */
    public function updateEstado($consultaID, $estadoNuevo){        
        try{
            $consulta = Consulta::find($consultaID);
            $consulta->estado = $estadoNuevo;
            $consulta->save();
        }catch(\Exception $e){
            return redirect()->route('consultas')->with('error', $e->getMessage());
        }

        return redirect()->route('consultas')->with('editado', 'Estado de la consulta actualizado con éxito');
    }


    /**
     * 
     */
    public function update(){        
        $this->validate([
            'cambiarVetId' => 'sometimes',            
        ]);
        
        try{
            $consulta = Consulta::find($this->consultaToEdit->id);
            $consulta->update([
                'veterinario_id' => $this->cambiarVetId,
            ]);
            $consulta->save();

            ConsultaVeterinario::where('consulta_id', $consulta->id)->update([
                'veterinario_id' => $this->cambiarVetId,
            ]);
                        
            return redirect()->route('consultas')->with('editado', 'Consulta actualizada con éxito');
        }catch(\Exception $e){
            return redirect()->route('consultas')->with('error', $e->getMessage());
        }

    }
    /**
     * 
     */
    public function mount(){        
        $this->mascotas = Mascota::all();

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

        //inicializa la fecha de la consulta. para que la fecha sea la actual automaticamente
        $this->fecha = now()->format('Y-m-d');
        //inicializa la hora de la consulta. para que la fecha sea la actual automaticamente
        $this->hora = now()->format('H:i');

        $this->consultas = Consulta::all();        
        $this->tipoConsultas = TipoConsulta::all();
        
    }   


    public function render()
    {          

        return view('livewire.consultas');
    }
}
