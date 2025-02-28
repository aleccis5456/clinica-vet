<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';

    protected $fillable = [
        'mascota_id', 	
        'veterinaria_id', 	
        'nacimiento', 	
        'tipo', 	
        'estado', 	
        'recordatorio', 	
        'notas'
    ];

    public function veterinarios(){
        return $this->belongsToMany(User::class, 'equipo_veterinario', 'equipo_id', 'veterinario_id');
    }    

    public function mascota(){
        return $this->belongsTo(Mascota::class);
    }
}
