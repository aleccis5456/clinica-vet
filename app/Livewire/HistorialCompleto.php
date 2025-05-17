<?php

namespace App\Livewire;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\ConsultaProducto;
use App\Models\ConsultaVeterinario;
use App\Models\Mascota;
use App\Models\Consulta;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Title('Historial Completo')]
class HistorialCompleto extends Component
{
    public $consultaId;
    public $consulta;
    public $mascota;     
    public $consultas;
    public $cantidad;
    public $consultaVeterinario;
    public $flag = false;
    public $productos;
    public $fecha;

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
    public function flagTrue(){
        $this->flag = true;
    }
    public function flagFalse(){
        $this->flag = false;
        $this->mount($this->consultaId);
    }

    public function filtro($consultaId){        
        $this->flagTrue();
        $this->productos = ConsultaProducto::where('consulta_id', $consultaId)
                                            ->where('owner_id', $this->ownerId())
                                            ->get();
        $this->consultas = Consulta::where('id',$consultaId)
                                    ->where('owner_id', $this->ownerId())
                                    ->get();        
        $this->consulta = Consulta::where('id',$consultaId)
                                    ->where('owner_id', $this->ownerId())
                                    ->first();        
        //$this->consultas = $this->consultas ? collect([$this->consultas]) : collect();     
        
        // foreach($this->consultas as $consulta){
        //    dd($consulta->veterinario->name);
        // }
    }    

    public function mount($id, $url = null){      
        if(!$this->consulta = Consulta::where('mascota_id', $id)->where('owner_id', $this->ownerId())->first()){
            return redirect('/')->with('warnig', 'No se encontraron consultas para la mascota seleccionada');
        }
        if(empty(session('modulos')['consulta'])){
            return redirect('/');
        }
        Helper::check();
        $this->consultaId = $id;
        $this->consulta = Consulta::where('mascota_id', $this->consultaId)->where('owner_id', $this->ownerId())->first();        
        $this->mascota = Mascota::where('id',$this->consulta->mascota_id)->where('owner_id', $this->ownerId())->first();                      
        $this->consultas = Consulta::where('mascota_id', $this->mascota->id)->where('owner_id', $this->ownerId())->get();
        $this->cantidad = Consulta::where('mascota_id', $this->mascota->id)->where('owner_id', $this->ownerId())->get();        
        $this->consultaVeterinario = ConsultaVeterinario::where('consulta_id', $this->consultaId)->where('owner_id', $this->ownerId())->get();        
        $this->fecha = Consulta::orderBy('id', 'desc')->where('owner_id', $this->ownerId())->first();        
    }
    public function eliminarConsulta($consultaId){        
        $consulta = Consulta::where('id', $consultaId)->where('owner_id', $this->ownerId())->first();
        $consulta->delete();  
        $this->consultas = Consulta::where('mascota_id', $this->mascota->id)->get();
        if(count($this->consultas) < 1){
            return redirect('/');
        }
    }
    public function render()
    {           
        return view('livewire.historial-completo');
    }
}
