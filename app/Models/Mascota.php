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
        'especie', 	
        'raza', 	
        'nacimiento', 	
        'genero', 	
        'historial_medico',
        'foto',
        'especie_id'
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
}
