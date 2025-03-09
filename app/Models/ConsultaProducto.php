<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultaProducto extends Model
{
    protected $table = 'consulta_productos';

    protected $fillable = [
        'producto_id', 	
        'consulta_id', 	
        'cantidad', 	
        'descripcion'
    ];

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function consulta(){
        return $this->belongsTo(Consulta::class, 'consulta_id');
    }
}
