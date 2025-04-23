<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultaVeterinario extends Model
{
    protected $table='veterinarios_consulta';

    protected $fillable = [
        'veterinario_id',
        'consulta_id',
        'owner_id'
    ];

    public function veterinario(){
        return $this->belongsTo(User::class, 'veterinario_id');
    }

    public function consulta(){
        return $this->belongsTo(Consulta::class, 'consulta_id');
    }
}
