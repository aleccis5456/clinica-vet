<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = ['nombre', 'owner_id'];   

    public function productos() {
        return $this->hasMany(Producto::class);
    }   
}
