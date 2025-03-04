<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermisoRol extends Model
{
    protected $table = 'permiso_rol';
    protected $fillable = ['rol_id', 'permiso_id'];
    public $timestamps = false;
}
