<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    protected $table = 'especies';

    protected $fillable = ['nombre'];


    public function mascotas(){
        return $this->hasMany(Mascota::class);
    }
}
