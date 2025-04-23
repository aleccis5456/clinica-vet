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
        'consulta_id',
        'owner_id',
    ];    
    
    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function tipoConsulta(){
        return $this->belongsTo(TipoConsulta::class, 'consulta_id');
    }

    public function movimiento(){
        return $this->belongsTo(Movimiento::class, 'venta_id');
    }
}
