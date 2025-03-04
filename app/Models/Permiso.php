<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = "permisos";

    protected $fillable = ['name'];

    public function roles(){
        return $this->belongsTo(Rol::class, 'permisos_rol', 'permiso_id', 'rol_id');
    }
}
