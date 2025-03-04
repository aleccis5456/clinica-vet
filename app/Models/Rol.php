<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    
    protected $fillable = ['name'];

    public function permisos(){
        return $this->belongsToMany(Permiso::class, 'permiso_rol', 'rol_id', 'permiso_id');
    }

    public function usuarios(){
        return $this->hasMany(User::class);
    }
    
}
