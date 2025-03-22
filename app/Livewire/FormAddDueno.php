<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\Dueno;
use App\Models\Mascota;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

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

    /**
     * 
     */
    public $duenos;
    public $mascotas;
    public $duenoToEdit;
    public $modalEdit = false;   
    public $duenoId = ''; 
    public $modalEliminar = false;
    public $duenoToDelete = '';
    public $search = '';
    public $modalAddDueno = false;

    /***
     * 
     */
    public function crearDueno(){
        $this->validate();
        
        Dueno::create([
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'email' => $this->email
        ]);

        return redirect('/')->with('agregado', "$this->nombre, se agrego correctamente");
    }

    /**
     * 
     */
    public function mount(){
        Helper::check();
        $this->duenos = Dueno::orderBy('id', 'desc')->take(10)->get();                       
        $this->mascotas = Mascota::all();


        if(empty(session('modulos')['gestionPaciente']['value'])){
            return redirect('/');
        }
    }
    /**
     * 
     */
    public function borrarDueno($duenoId){        
        $dueno = Dueno::find($duenoId);

        $dueno->delete();
        
        return redirect('/registrar/dueno')->with('eliminado', '.');
    }  
    /**
     * 
     */
    public function openModalEdit($duenoId){
        $this->modalEdit = true;        
        $this->duenoToEdit = Dueno::find($duenoId);
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
        $dueno = Dueno::find($this->duenoId);                
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
            $this->duenos = Dueno::orderBy('id', 'desc')->take(10)->get();                       
        }else{
            $this->duenos = Dueno::whereLike('nombre', '%' . $this->search . '%')->get();                                  
        }
        
        //
    }  
    public function flag(){
        $this->search = '';
        $this->duenos = $this->duenos = Dueno::orderBy('id', 'desc')->take(10)->get();                       
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
    
    public function render()
    {                                    
        return view('livewire.form-add-dueno');
    }
}
