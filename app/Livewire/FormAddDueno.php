<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use App\Helpers\Helper;
use App\Models\Dueno;
use App\Models\Mascota;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

#[Title('Agregar Dueno')]
class FormAddDueno extends Component
{     
    /**
     * 
     */
    #[Rule('required', message: 'Ingrese un nombre')]
    public $nombre = '';

    #[Rule('required', message: 'Ingrese un numero de telefono')]
    #[Rule('numeric', message: 'Ingrese un numero valido')]
    public $telefono = '';

    #[Rule('required', message: 'Ingrese un email')]
    public $email = '';
    public object $duenos;
    public object $mascotas;
    public object $duenoToEdit;
    public bool $modalEdit = false;   
    public string $duenoId = ''; 
    public bool $modalEliminar = false;
    public string $duenoToDelete = '';
    public string $search = '';
    public bool $modalAddDueno = false;


    /**
     * 
     */
    public function mount(){
        if(empty(session('modulos')['gestionPaciente'])){
            return redirect('/');
        }
        Helper::check();
                                             
        $this->duenos =  $this->getDuenos();                   
        $this->mascotas = $this->getMascotas();
    }
    /**
     * 
     */
    public function getDuenos(){
        return Dueno::orderBy('id', 'desc')
                    ->where('owner_id', $this->ownerId())
                    ->take(10)
                    ->get();   
    }
    /**
     * 
     */
    public function getMascotas(){
        return Mascota::where('owner_id', $this->ownerId())->get();   
    }   

    /**
     * 
     */
    #[On('success')]
    public function refreshSuccess(){
        $this->closeModalAddDueno();    
        $this->duenos = $this->getDuenos();
    }
    #[On('error')]
    public function refreshError(){
    }

    public function ownerId(){
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

    /***
     * 
     */
    public function crearDueno(){
        $this->validate();
        try{
            Dueno::create([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'email' => $this->email,
                'owner_id' => $this->ownerId()
            ]);
        }catch(\Exception $e){
            $this->dispatch('error', $e->getMessage());
        }
        $this->dispatch('success', 'Dueno creado correctamente');
    }
    
    /**
     * 
     */
    public function borrarDueno($duenoId){        
        $dueno = Dueno::where('id', $duenoId)
                        ->where('owner_id', $this->ownerId())
                        ->first();

        $dueno->delete();
        
        $this->dispatch('success', 'Dueno eliminado correctamente');
        $this->closeModalEliminar();
    }  
    /**
     * 
     */
    public function openModalEdit($duenoId){
        $this->modalEdit = true;        
        $this->duenoToEdit = Dueno::where('id', $duenoId)
                                    ->where('owner_id', $this->ownerId())
                                    ->first();
        $this->duenoId = $duenoId;
    }

    public function closeModalEdit(){
        $this->modalEdit = false;
    }

    /**
     * 
     */
    public function editSave(){                                     
        $this->validate([
            'nombre' => 'sometimes',
            'telefono' => 'sometimes',
            'email' => 'sometimes',
            'duenoId' => 'required'
        ]);                
        $dueno = Dueno::where('id', $this->duenoId)
                        ->where('owner_id', $this->ownerId())
                        ->first();   

        $dueno->update([
            'nombre' => empty($this->nombre) ? $dueno->nombre : $this->nombre,
            'telefono' => empty($this->telefono) ? $dueno->telefono : $this->telefono,
            'email' => empty($this->email) ? $dueno->email : $this->email,
        ]);
        
        $dueno->save();

        return redirect('/registrar/dueno')->with('editado', ".");
    }

    /**
     * 
     */
    public function opneModalEliminar($duenoId){
        $this->duenoToDelete = $duenoId;            
        $this->modalEliminar = true;
    }
    public function closeModalEliminar(){
        $this->modalEliminar = false;
    }

    /**
     * 
     */
    public function filtrar(){
        if(empty($this->search)){
            $this->duenos = Dueno::orderBy('id', 'desc')
                                ->where('owner_id', $this->ownerId())
                                ->take(10)
                                ->get();                       
        }else{
            $this->duenos = Dueno::whereLike('nombre', '%' . $this->search . '%')
                                ->where('owner_id', $this->ownerId())
                                ->get();                                  
        }
        
        //
    }  
    public function flag(){
        $this->search = '';
        $this->duenos = $this->duenos = Dueno::orderBy('id', 'desc')
                                            ->take(10)
                                            ->where('owner_id', $this->ownerId())
                                            ->get();                       
    }

    /**
     *
     */ 
    public function openModalAddDueno(){
        $this->modalAddDueno = true;
    }
    public function closeModalAddDueno(){
        $this->modalAddDueno = false;
    }  
    
    public function render() {                                    
        return view('livewire.form-add-dueno');
    }
}
