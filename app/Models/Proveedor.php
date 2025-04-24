<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model {
    
    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'telefono',
        'direccion',
        'email',
        'ruc',
        'owner_id',
    ];

    public function productos() :HasMany {
        return $this->hasMany(Producto::class);
    }
}
