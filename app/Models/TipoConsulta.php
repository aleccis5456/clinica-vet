<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoConsulta extends Model
{
    protected $table = 'tipo_consultas';
    protected $fillable = [
        'nombre', 
        'descripcion',
        'precio',
        'veces_realizadas',
        'owner_id',
    ];
    public $timestamps = false;

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }
}
