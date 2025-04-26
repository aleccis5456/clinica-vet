<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dueno extends Model
{
    protected $table = 'duenos';

    protected $fillable = [
        'nombre', 	
        'telefono', 	
        'email',
        'owner_id'
    ];
    
    public function mascotas(){
        return $this->hasMany(Mascota::class);
    }    

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function cajas(){
        return $this->hasMany(Caja::class);
    }
}
