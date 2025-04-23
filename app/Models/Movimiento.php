<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';

    protected $fillable = [
        'codigo', 	
        'monto', 	
        'cliente_id', 	
        'forma_pago',
        'owner_id'
    ];

    public function cliente(){
        return $this->belongsTo(DatosFactura::class, 'cliente_id');
    }

    public function productos(){
        return $this->belongsToMany(Producto::class, 'movimiento_productos', 'movimiento_id', 'producto_id');
    }    
}
