<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsoInterno extends Model
{
    protected $table = 'uso_internos';

    protected $fillable = [
        'producto_id',
        'consulta_id',
        'cantidad',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}
