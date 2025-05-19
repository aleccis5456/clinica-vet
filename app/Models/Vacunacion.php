<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacunacion extends Model
{
    protected $table = 'vacunaciones';
    protected $fillable = [
        'mascota_id',
        'producto_id',
        'consulta_id',
        'fecha_vacunacion',
        'etiqueta',
        'notas',
        'owner_id',
        'proxima_vacunacion',
        'proxima_vacuna',
        'aplicada',
    ];
    
    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}
