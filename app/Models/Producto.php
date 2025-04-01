<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre', 	
        'descripcion', 	
        'categoria_id', 	
        'precio', 	
        'precio_compra', 	
        'stock_actual', 	
        'foto',
        'ventas',
        'codigo',
        'codigo_barras',
        'proveedor_id',
    ];

    public function movimientos() : BelongsToMany {
        return $this->belongsToMany(Movimiento::class, 'movimiento_productos', 'producto_id', 'movimiento_id');
    }

    public function tipoCategoria() : belongsTo {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    
    public function consultas() :BelongsToMany {
        return $this->belongsToMany(Consulta::class, 'consulta_productos', 'producto_id', 'consulta_id');
    }

    public function proveedor() : belongsTo {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
