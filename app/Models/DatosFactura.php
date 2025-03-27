<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosFactura extends Model
{
    protected $table = 'datos_facturas';

    protected $fillable = [
        'nombre_rs', 	
        'ruc_ci'
    ];

    public function compras(){
        return $this->hasMany(Movimiento::class);
    }
}

