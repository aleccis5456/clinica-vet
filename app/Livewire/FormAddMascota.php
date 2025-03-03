<?php

namespace App\Livewire;

use App\Models\Dueno;
use App\Models\Especie;
use App\Models\Mascota;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

#[Title('Gestion Mascotas')]
class FormAddMascota extends Component
{
    use WithFileUploads;

    #[Rule('nullable')]
    public $dueno_id = '';
    public $nombre = '';
    public $especie = '';
    public $raza = '';
    public $nacimiento;
    public $genero = '';
    public $historial_medico = '';

    #[Rule('image', message: 'Usar un formato correcto')]
    #[Rule('nullable')]
    public $foto;
    //    #[Rule('required', message: 'Ingrese un nombre')]
    public $modalAdd = false;
    public $mascotas;
    public $duenos;
    public $especies;
    public $modalEspecies = false;
    public $tableEspecies = false;
    public $modalEliminar = false;
    public $mascotaId = '';
    public $mascotaToEdit;
    public $modalEdit = false;
    /**
     * 
     */
    public function openModalEdit($mascotaId){
        $mascotaToEdit = Mascota::find($mascotaId);
        if(!$mascotaToEdit){
            $this->redirect('/registrar/mascota');
        }

        $this->mascotaToEdit = $mascotaToEdit;
        $this->modalEdit = true;
    }
    public function closeModalEdit(){
        $this->modalEdit = false;
    }

    /**
     * 
     */
    public function openModalEliminar($mascotaId){
        $this->mascotaId = $mascotaId;
        $this->modalEliminar = true;
    }
    public function closeModalEliminar(){
        $this->modalEliminar = false;
    }

    /**
     * 
     */
    public function eliminar($mascotaId){
        $mascota = Mascota::find($mascotaId);
        if(!$mascota){
            $this->redirect('/registrar/mascota');
        }
        $mascota->delete();

        return redirect('/registrar/mascota')->with('eliminado', 'Mascota eliminado');
    }


    /**
     * 
     */
    public function openTableEspecies(){
        $this->tableEspecies = true;
    }
    public function closeTableEspecies(){
        $this->tableEspecies = false;
    }

    public function eliminarEspecie(Especie $especie){                 
        $especie->delete();

        return redirect('/registrar/mascota')->with('eliminado', "Especie borrado");
    }
    /**
     * 
     */
    public function crearEspecie(){
        $this->validate([
            'especie' => 'required'            
        ]);

        Especie::create([
            'nombre' => $this->especie
        ]);

        return redirect('/registrar/mascota')->with('agregado', "$this->especie, se agrego correctamente");
    }

    public function openModalEspecies(){
        $this->modalEspecies = true;
    }
    public function closeModalEspecies(){
        $this->modalEspecies = false;
    }
    /**
     * 
     */
    public function openModalAdd(){
        $this->modalAdd = true;
    }
    public function closeModalAdd(){
        $this->modalAdd = false;
    }

    /**
     * 
     */
    public function mount(){
        $this->mascotas = Mascota::all();
        $this->duenos = Dueno::all();
        $this->especies = Especie::all();
    }
    public function render()
    {
        return view('livewire.form-add-mascota');
    }
}
