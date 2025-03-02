<?php

namespace App\Livewire;

use App\Models\Dueno;
use App\Models\Mascota;
use Illuminate\Support\Facades\Date;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

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

    
    // public function crearMascota(){
    //     $this->validate();
    //     $imageName = null;
    //     if ($this->foto) {
    //         $imageName = time() . '_' . $this->nombre . '.' . $this->foto->getClientOriginalExtension();
    //         $this->foto->storeAs('uploads/mascotas', $imageName, 'public');
    //     }

    //     // Guardar la mascota en la BD
    //     Mascota::create([
    //         'dueno_id' => $this->dueno_id,
    //         'nombre' => $this->nombre,
    //         'especie' => $this->especie,
    //         'raza' => $this->raza,
    //         'nacimiento' => $this->nacimiento,
    //         'genero' => $this->genero,
    //         'historial_medico' => $this->historial_medico,
    //         'foto' => $imageName // Aquí se guarda el nombre del archivo correctamente
    //     ]);


    //     return redirect('/')->with('agregado', "$this->nombre, se agrego correctamente");
    // }
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
    }
    public function render()
    {
        return view('livewire.form-add-mascota');
    }
}
