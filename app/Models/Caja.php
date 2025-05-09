<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = "cajas";

    protected $casts = [
        'productos' => 'array',
    ];

    protected $fillable = [
        'consulta_id',
        'dueno_id',
        'mascota_id',
        'producto_consulta_id',
        'owner_id',
        'pago_estado',
        'monto_total',
        'productos',
    ];

    public function consulta() {
        return $this->belongsTo(Consulta::class);
    }
    public function dueno(){
        return $this->belongsTo(Dueno::class);
    }

    public function mascota(){
        return $this->belongsTo(Mascota::class);
    }
    public function productoConsulta(){
        return $this->belongsTo(ConsultaProducto::class);
    }
    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function casts(): array{
        return [
            'productos' => 'array'
        ];
    }
}
