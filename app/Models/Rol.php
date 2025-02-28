<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    
    protected $fillable = ['name'];

    public function permisos(){
        return $this->belongsToMany(Permiso::class, 'permisos_rol', 'permisi_id', 'rol_id');
    }

    public function usuarios(){
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
    
}
