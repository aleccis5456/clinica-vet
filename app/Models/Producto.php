<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre', 	
        'descripcion', 	
        'categoria', 	
        'precio', 	
        'stock_actual'
    ];

    public function movimientos(){
        return $this->belongsToMany(Movimiento::class, 'movimiento_productos', 'producto_id', 'movimiento_id');
    }
    
    
}
