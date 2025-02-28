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
        'forma_pago'
    ];

    public function cliente(){
        return $this->belongsTo(Dueno::class, 'cliente_id');
    }
}
