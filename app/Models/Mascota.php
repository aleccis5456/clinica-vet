<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mascota extends Model
{
    use SoftDeletes;
    protected $table = 'mascotas';

    protected $fillable = [
        'dueno_id', 	
        'nombre', 	
        
        'raza', 	
        'nacimiento', 	
        'genero', 	
        'historial_medico',
        'foto',
        'especie_id',
        'owner_id'
    ];

    // protected $casts = [
    //     'nacimiento' => 'date',
    // ];

    public function dueno(){
        return $this->belongsTo(Dueno::class, 'dueno_id');
    }

    public function especieN(){
        return $this->belongsTo(Especie::class, 'especie_id');
    }
    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function cajas(){
        return $this->hasMany(Caja::class);
    }
    public function vacunas(){
        return $this->hasMany(Vacunacion::class);
    }

    public function ultimaVacuna(){
        return $this->hasOne(Vacunacion::class)->orderBy('proxima_vacunacion', 'asc');
    }

    public function vacunaVencida(){
        return $this->hasMany(Vacunacion::class)->where('proxima_vacunacion', '<', now());
    }
}
