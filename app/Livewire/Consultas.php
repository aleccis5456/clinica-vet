<?php

namespace App\Livewire;

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
    public $mascota_id,	$veterinario_id, $fecha, $tipo, $sintomas, $diagnostico, $tratamiento, 	$notas;   
    public $consultas;
    public $cambiarVet = false;
    
    public $vetChanged = '';
    public $addConsulta = false;
    public $modalConfig = false;
    public $consultaToEdit;
    public $message = false;
    public $cambiarVetId = '';
    public $productos;
    

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
            ],[

            ]);
        }catch(\Exception $e){
            return redirect()->route('consultas')->with('error', $e->getMessage());
        }
            

        try{

            foreach($this->consultas as $consulta){
                if($consulta->mascota_id == $this->mascota_id && $consulta->estado !== 'Finalizado' or $consulta->estado !== 'Cancelado'){
                    return redirect()->route('consultas')->with('error', 'Ya existe una consulta pendiente para esta mascota');
                }

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

    public function update(){
        $this->validate([
            'cambiarVetId' => 'sometimes',
        ]);

        try{
            $consulta = Consulta::find($this->consultaToEdit->id);
            $consulta->veterinario_id = $this->cambiarVetId;
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

        $this->consultas = Consulta::all();
        $this->productos = Producto::all();
        
    }   


    public function render()
    {          

        return view('livewire.consultas');
    }
}
