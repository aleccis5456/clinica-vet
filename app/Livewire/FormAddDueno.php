<?php

namespace App\Livewire;

use App\Models\Dueno;
use App\Models\Mascota;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Agregar Dueno')]
class FormAddDueno extends Component
{     
    /***
     * 
     */
    #[Rule('required', message: 'Agrega un nombre')]
    public $nombre = '';

    #[Rule('required', message: 'Agrega un numero de telefono')]
    #[Rule('numeric', message: 'Numero requerido')]
    public $telefono = '';

    #[Rule('required', message: 'Agrega un email')]
    public $email = '';

    /***
     * 
     */
    public $duenos;
    public $mascotas;
    public $duenoToEdit;
    public $modalEdit = false;

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

    /***
     * 
     */
    public function mount(){
        $this->duenos = Dueno::all();
        $this->mascotas = Mascota::all();
    }

    /**
     * 
     */
    public function borrarDueno($duenoId){
        $dueno = Dueno::find($duenoId);

        $dueno->delete();
        
        $this->redirect('/registrar/dueno');
    }  
    /**
     * 
     */
    public function openModalEdit($duenoId){
        $this->modalEdit = true;        
        $this->duenoToEdit = Dueno::find($duenoId);
    }

    public function closeModalEdit(){
        $this->modalEdit = false;
    }

    public function render()
    {
        return view('livewire.form-add-dueno');
    }
}
