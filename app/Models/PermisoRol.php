<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermisoRol extends Model
{
    protected $table = 'prermiso_rols';

    protected $fillable = ['permiso_id', 'rol_id', 'owner_id'];
        
}
