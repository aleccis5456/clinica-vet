<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dueno extends Model
{
    protected $table = 'duenos';

    protected $fillable = [
        'nombre', 	
        'telefono', 	
        'email'
    ];
    
    public function mascotas(){
        return $this->hasMany(Mascota::class);
    }

    public function compras(){
        return $this->hasMany(Movimiento::class);
    }
}
