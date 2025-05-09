<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
        'dueno_id', 	
        'consulta_id', 	
        'monto', 	
        'forma_pago', 	
        'notas', 	
        'pagado', 	
        'cuotas', 	
        'cantidad_pagos', 	
        'fecha_pago', 	
        'fecha_vencimiento', 	
        'estado', 	
        'comprobante',
        'cliente_id',
        'owner_id'
    ];

    public function duenos(){
        return $this->hasMany(Dueno::class, 'dueno_id');
    }

    public function consultas(){
        return $this->hasMany(Consulta::class, 'consulta_id');
    }

    public function clientes(){
        return $this->hasMany(DatosFactura::class, 'cliente_id');
    }
}
