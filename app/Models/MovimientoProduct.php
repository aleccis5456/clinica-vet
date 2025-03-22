<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoProduct extends Model
{
    protected $table = "mivimiento_products";

    protected $fillable = [
        'venta_id', 	
        'producto_id', 	
        'cantidad', 	
        'precio_unitario', 	
        'precio_total',
        'consulta_id'
    ];    
}
