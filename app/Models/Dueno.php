<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dueno extends Model
{
    protected $table = 'duenos';

    protected $fillable = [
        'nombre', 	
        'telefono', 	
        'email'
    ];
    

    public function mascoteas(){
        return $this->hasMany(Mascota::class);
    }
}
