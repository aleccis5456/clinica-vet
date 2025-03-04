<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolUser extends Model
{
    protected $table = 'role_user';
    protected $fillable = ['user_id', 'role_id'];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function rol(){
        return $this->belongsTo(Rol::class);
    }
}
