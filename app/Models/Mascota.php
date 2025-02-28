<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $table = 'mascotas';

    protected $fillable = [
        'dueno_id', 	
        'nombre', 	
        'especie', 	
        'raza', 	
        'nacimiento', 	
        'genero', 	
        'historial_medico'
    ];

    public function dueno(){
        return $this->belongsTo(Dueno::class, 'dueno_id');
    }
}
