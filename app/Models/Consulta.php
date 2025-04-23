<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consultas';
    //protected $with = ['mascota'];    

    protected $fillable = [
        'mascota_id', 	
        'veterinario_id', 	
        'fecha', 	
        'tipo_id', 	
        'sintomas', 	
        'diagnostico', 	
        'tratamiento', 	
        'notas',
        'estado',        
        'hora',
        'codigo',
        'owner_id',
    ];

    public function mascota(){
        return $this->belongsTo(Mascota::class, 'mascota_id');
    }

    public function veterinario(){
        return $this->belongsTo(User::class, 'veterinario_id');
    }

    public function tipoConsulta(){
        return $this->belongsTo(TipoConsulta::class, 'tipo_id');
    }

    public function productos(){
        return $this->belongsToMany(Producto::class, 'consulta_productos', 'consulta_id', 'producto_id');
    }

    public function movimientos(){
        return $this->belongsToMany(Movimiento::class, 'movimiento_productos', 'consulta_id', 'movimiento_id');
    }

}
