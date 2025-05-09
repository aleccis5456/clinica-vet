<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    protected $table = 'especies';

    protected $fillable = ['nombre', 'owner_id'];


    public function mascotas(){
        return $this->hasMany(Mascota::class);
    }
}
