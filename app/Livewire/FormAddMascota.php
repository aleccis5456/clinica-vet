<?php

namespace App\Livewire;

use App\Helpers\Helper;
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
    public string $dueno_id = '';    
    public string $genero = '';
    public string $nombre = '';
    public string $especie = '';
    public string $raza = '';
    public ?string $nacimiento = null;
    public string $historial_medico = '';
    public string $flagEliminarHM = '';
    public string $flagElimiarFoto = '';    

    #[Rule('image', message: 'Usar un formato correcto')]
    #[Rule('nullable')]
    public string $foto;
    //    #[Rule('required', message: 'Ingrese un nombre')]
    public bool $modalAdd = false;
    public object $mascotas;
    public object $duenos;
    public object $especies;
    public bool $modalEspecies = false;
    public bool $tableEspecies = false;
    public bool $modalEliminar = false;
    public string $mascotaId = '';
    public object $mascotaToEdit;
    public bool $modalEdit = false;
    public string $search = '';    
    public bool $buscarDueno = false;
    public string $dueno = '';
    public ?object $duenosEcontrados;

      /***
     * LA CREACION Y EDICION ESTA EN UN CONTROLADOR (para poder guardar la foto en public_path) 
     */

       /**
     * 
     */
    public function mount(){
        Helper::check();
        $this->mascotas = Mascota::orderBy('id', 'desc')->take(10)->get();     
        $this->duenos = Dueno::all();
        $this->especies = Especie::all();          

        if(empty(session('modulos')['gestionPaciente'])){
            return redirect('/');
        }
    }

    /**
     * 
     */
    public function selectDueno(int $duenoId){
        $this->dueno_id = $duenoId;
        $this->buscarDuenoFalse();
        $this->dueno = '';
        $this->duenosEcontrados = null;
    }

    /**
     * 
     */
    public function buscarDuenoTrue() :void {
        $this->buscarDueno = true;
    }
    public function buscarDuenoFalse() :void {
        $this->buscarDueno = false;
    }      

    public function searchDueno() : void {        
        $this->validate([
            'dueno' => 'required'
        ]);

        $this->duenosEcontrados = Dueno::where('nombre', 'like', "%$this->dueno%")->get();                        
        $this->buscarDuenoTrue();        
    } 

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

    public function eliminarEspecie($especie){                 
        $especie = Especie::find($especie);
        if(!$especie){
            $this->redirect('/registrar/mascota');
        }

        if($especie->mascotas->count() > 0){
            return redirect('/registrar/mascota')->with('error', 'No se puede eliminar la especie, tiene mascotas asociadas');

        }
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
    public function filtrar(){
        if(empty($this->search)){
            $this->mascotas = Mascota::orderBy('id', 'desc')->take(10)->get();     
        }else{
            $this->mascotas = Mascota::whereLike('nombre', "%$this->search%")->get();
        }
    }

    public function flag(){
        $this->search = '';
        $this->mascotas = Mascota::orderBy('id', 'desc')->take(10)->get();     
    }

    public function render()
    {
        return view('livewire.form-add-mascota');
    }
}
