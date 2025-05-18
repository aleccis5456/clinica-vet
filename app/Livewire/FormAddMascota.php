<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Vacunacion;
use App\Helpers\Helper;
use App\Models\User;
use App\Models\Dueno;
use Livewire\Attributes\On;
use App\Models\Especie;
use App\Models\Mascota;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Carbon\Carbon;

#[Title('Gestion Mascotas')]
class FormAddMascota extends Component
{
    use WithFileUploads, WithPagination;

    #[Rule('nullable')]
    public int $dueno_id;
    public string $genero = '';
    public string $nombre = '';
    public string $especie = '';
    public string $raza = '';
    public ?string $nacimiento = null;
    public string $historial_medico = '';
    public string $flagEliminarHM = '';
    public string $flagElimiarFoto = '';
    public $duenoSeleccionado;

    #[Rule('image', message: 'Usar un formato correcto')]
    #[Rule('nullable')]
    public $foto;
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
    public ?string $dueno;
    public ?object $duenosEcontrados;

    //variables para duenos
    #[Rule('required', message: 'Ingrese un nombre')]
    public $nombredueno = '';

    #[Rule('required', message: 'Ingrese un numero de teléfono')]
    #[Rule('numeric', message: 'Ingrese un numero valido')]
    public $telefonodueno = '';

    #[Rule('required', message: 'Ingrese un email')]
    public $emaildueno = '';
    public bool $modalDueno = false;
    public bool $tarjeta = false;
    public ?object $mascotaT;
    public $etiqueta;
    public  $preview;
    public $vacunaId;
    public ?object $vacunas;
    public bool $filtro = false;
    public string $desde;
    public string $hasta;
    public bool $vacunaq = false;
    public bool $addNota = false;
    public string $nota = '';
    public string $notaEdit;
    public ?object $vacuna;

    /***
     * LA CREACION Y EDICION ESTA EN UN CONTROLADOR (para poder guardar la foto en public_path) 
     */

    /**
     * 
     */
    public function mount()
    {
        if (empty(session('modulos')['gestionPaciente'])) {
            return redirect('/');
        }
        Helper::check();

        $this->mascotas = Mascota::orderBy('id', 'desc')
            ->where('owner_id', $this->ownerId())
            ->take(10)
            ->get();
        $this->duenos = Dueno::where('owner_id', $this->ownerId())->get();
        $this->especies = Especie::where('owner_id', $this->ownerId())->get();
    }

    /**
     * 
     */
    public function addNotaTrue()
    {
        $this->addNota = true;
    }
    public function addNotaFalse()
    {
        $this->addNota = false;
    }
    public function guardarNota(int $vacunaId): void
    {
        $this->validate([
            'nota' => 'required'
        ]);
        $vacuna = Vacunacion::where('id', $vacunaId)->where('owner_id', $this->ownerId())->first();
        if (!$vacuna) {
            return;
        }
        $vacuna->update([
            'notas' => $this->nota
        ]);
        $this->dispatch('success', 'Nota guardada');
        $this->addNotaFalse();
    }
    public function updateNota(int $vacunaId){
        $this->validate([
            'notaEdit' => 'required'
        ]);
        $vacuna = Vacunacion::where('id', $vacunaId)->where('owner_id', $this->ownerId())->first();
        if (!$vacuna) {;
            return;
        }
        $vacuna->update([
            'notas' => $this->notaEdit
        ]);
        $this->dispatch('success', 'Nota guardada');
    }
    /**
     * 
     */
    public function filtroTrue()
    {
        $this->filtro = true;
    }
    public function filtroFalse()
    {
        $this->filtro = false;
    }
    public function filtrarVacunas()
    {
        $desde = empty($this->desde) ? now()->startOfDay()->format('Y-m-d') : Carbon::parse($this->desde)->format('Y-m-d');
        $hasta = empty($this->hasta) ? now()->endOfDay()->format('Y-m-d') :  Carbon::parse($this->hasta)->format('Y-m-d');

        $this->vacunas = Vacunacion::where('mascota_id', $this->mascotaT->id)
            ->where('owner_id', $this->ownerId())
            ->where('fecha_vacunacion', '>=', $desde)
            ->where('fecha_vacunacion', '<=', $hasta)
            ->orderBy('id', 'desc')
            ->get();
        $this->vacunaq = true;

        $this->filtroFalse();
    }

    /**
     * 
     */
    public function tarjetaTrue($mascotaId)
    {
        $this->mascotaT = Mascota::where('id', $mascotaId)
            ->where('owner_id', $this->ownerId())
            ->first();

        $this->vacunas = Vacunacion::where('mascota_id', $this->mascotaT->id)
            ->where('owner_id', $this->ownerId())            
            ->orderBy('id', 'desc')
            ->get();

        $this->vacuna = Vacunacion::where('mascota_id', $this->mascotaT->id)
            ->where('owner_id', $this->ownerId())
            ->where('notas', '!=', null)
            ->first();
        if ($this->vacuna) {
        $this->notaEdit = $this->vacuna->notas;
        }
        $this->vacunaq = false;
        $this->tarjeta = true;
    }
    public function tarjetaFalse()
    {
        $this->tarjeta = false;
    }
    /**
     * 
     */
    public function mostrarDuenoTrue(): void
    {
        $this->modalDueno = true;
    }
    public function mostrarDuenoFalse(): void
    {
        $this->modalDueno = false;
    }
    public function crearDuenoMascota()
    {
        $this->validate();

        Dueno::create([
            'nombre' => $this->nombredueno,
            'telefono' => $this->telefonodueno,
            'email' => $this->emaildueno,
            'owner_id' => $this->ownerId()
        ]);
        $this->duenos = Dueno::where('owner_id', $this->ownerId())->get();
        $this->dispatch('dueno-add');
    }

    #[On('dueno-add')]
    public function refreshDueno()
    {
        $this->mostrarDuenoFalse();
    }

    public function ownerId(): mixed
    {
        $requestUserId = Auth::user()->id;
        $user = User::find($requestUserId);
        if ($user->admin) {
            $admin_id = $user->id;
        } else {
            $admin_id = $user->admin_id;
        }
        if ($admin_id == null) {
            return back()->with('error', 'No tienes permisos para agregar una mascota');
        }
        return $admin_id;
    }

    /**
     * 
     */
    public function selectDueno(int $duenoId)
    {
        $this->dueno_id = $duenoId;
        $this->duenoSeleccionado = Dueno::where('id', $this->dueno_id)
            ->where('owner_id', $this->ownerId())
            ->pluck('nombre')
            ->first();
        $this->buscarDuenoFalse();
        $this->dueno = '';
        $this->duenosEcontrados = null;
    }
    /**
     * 
     */
    public function buscarDuenoTrue(): void
    {
        $this->buscarDueno = true;
    }
    public function buscarDuenoFalse(): void
    {
        $this->buscarDueno = false;
    }

    public function searchDueno(): void
    {
        $this->validate([
            'dueno' => 'required'
        ]);
        $this->duenosEcontrados = Dueno::where('nombre', 'ilike', "%$this->dueno%")
            ->where('owner_id', $this->ownerId())
            ->get();
        $this->buscarDuenoTrue();
    }

    /**
     * 
     */
    public function openModalEdit($mascotaId)
    {
        $mascotaToEdit = Mascota::where('id', $mascotaId)
            ->where('owner_id', $this->ownerId())
            ->first();
        if (!$mascotaToEdit) {
            $this->redirect('/registrar/mascota');
        }
        $this->mascotaToEdit = $mascotaToEdit;
        $this->modalEdit = true;
    }
    public function closeModalEdit()
    {
        $this->modalEdit = false;
    }

    /**
     * 
     */
    public function openModalEliminar($mascotaId)
    {
        $this->mascotaId = $mascotaId;
        $this->modalEliminar = true;
    }
    public function closeModalEliminar()
    {
        $this->modalEliminar = false;
    }

    /**
     * 
     */
    public function eliminar($mascotaId)
    {
        $mascota = Mascota::where('id', $mascotaId)
            ->where('owner_id', $this->ownerId())
            ->first();
        if (!$mascota) {
            $this->redirect('/registrar/mascota');
        }
        $mascota->delete();

        return redirect('/registrar/mascota')->with('eliminado', 'Mascota eliminado');
    }

    /**
     * 
     */
    public function openTableEspecies()
    {
        $this->tableEspecies = true;
    }
    public function closeTableEspecies()
    {
        $this->tableEspecies = false;
    }

    public function eliminarEspecie($especie)
    {
        $especie = Especie::where('id', $especie)
            ->where('owner_id', $this->ownerId())
            ->first();
        if (!$especie) {
            $this->redirect('/registrar/mascota');
        }

        if ($especie->mascotas->count() > 0) {
            return redirect('/registrar/mascota')->with('error', 'No se puede eliminar la especie, tiene mascotas asociadas');
        }
        $especie->delete();

        return redirect('/registrar/mascota')->with('eliminado', "Especie borrado");
    }
    /**
     * 
     */
    public function crearEspecie()
    {
        $this->validate([
            'especie' => 'required',
        ]);

        Especie::create([
            'nombre' => $this->especie,
            'owner_id' => $this->ownerId(),
        ]);
        $this->dispatch('especie-add');
    }

    public function openModalEspecies()
    {
        $this->modalEspecies = true;
    }
    public function closeModalEspecies()
    {
        $this->modalEspecies = false;
    }
    /**
     * 
     */
    public function openModalAdd()
    {
        $this->modalAdd = true;
    }
    public function closeModalAdd()
    {
        $this->modalAdd = false;
    }

    /**
     * 
     */
    public function filtrar()
    {
        if (empty($this->search)) {
            $this->mascotas = Mascota::orderBy('id', 'desc')
                ->where('owner_id', $this->ownerId())
                ->take(10)
                ->get();
        } else {
            $this->mascotas = Mascota::whereLike('nombre', "%$this->search%")
                ->where('owner_id', $this->ownerId())
                ->get();
        }
    }

    public function flag()
    {
        $this->search = '';
        $this->mascotas = Mascota::orderBy('id', 'desc')
            ->where('owner_id', $this->ownerId())
            ->take(10)
            ->get();
    }
    #[On('especie-add')]
    public function refresh(): void
    {
        $this->especie = '';
        $this->especies = Especie::where('owner_id', $this->ownerId())->get();
    }

    public function updatedEtiqueta()
    {
        if ($this->etiqueta) {
            $this->preview = $this->etiqueta->temporaryUrl();
        }
    }

    public function removeImage()
    {
        $this->etiqueta = null;
        $this->preview = null;
    }

    public function guardarEtiqueta($vacunaId)
    {
        $this->validate([
            'etiqueta' => 'required|image|max:2048',
        ]);
        if ($this->etiqueta) {
            $imageName = time() . '.' . $this->etiqueta->getClientOriginalExtension();
            $this->etiqueta->storeAs('uploads/etiquetas', $imageName, 'public_path');
        } else {
            return;
        }
        $vacuna = Vacunacion::where('id', $vacunaId)->where('owner_id', $this->ownerId())->first();

        $vacuna->update([
            'etiqueta' => $imageName
        ]);

        $this->dispatch('success', 'Etiqueta guardada');
    }

    public function deleteImage($vacunaId)
    {
        $vacuna = Vacunacion::where('id', $vacunaId)->where('owner_id', $this->ownerId())->first();
        if (!$vacuna) {
            $this->dispatch('error', 'No se encontro la vacuna');
            return;
        }
        if ($vacuna->etiqueta) {
            $path = public_path('uploads/etiquetas/' . $vacuna->etiqueta);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $vacuna->update([
            'etiqueta' => null
        ]);
        $this->dispatch('success', 'Etiqueta eliminada');
    }
    public function setVacunaId($vacunaId)
    {
        $this->vacunaId = $vacunaId;
    }

    #[On('success')]
    public function refresh2() {}
    public function render()
    {
        return view('livewire.form-add-mascota');
    }
}
