<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = [
        'titulo', 	
        'descripcion', 	
        'fecha_hora', 	
        'usuario_id', 	
        'consulta_id', 	
        'estado'
    ];

    public function consulta(){
        return $this->belongsTo(Consulta::class, 'consulta_id');
    }
}
