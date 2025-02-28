<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consultas';
    protected $with = ['mascota'];

    protected $fillable = [
        'mascota_id', 	
        'veterinario_id', 	
        'fecha', 	
        'tipo', 	
        'sintomas', 	
        'diagnostico', 	
        'tratamiento', 	
        'notas'
    ];

    public function mascota(){
        return $this->belongsTo(Mascota::class, 'mascota_id');
    }

    public function veterinario(){
        return $this->belongsTo(User::class);
    }
}
