<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MivimientoProduct extends Model
{
    protected $table = "mivimiento_products";

    protected $fillablle = [
        'venta_id', 	
        'producto_id', 	
        'cantidad', 	
        'precio_unitario', 	
        'precio_total'
    ];    
}
