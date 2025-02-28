<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mivimiento_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->constrained('movimientos');
            $table->foreignId('producto_id')->constrained('productos');
            $table->integer('cantidad');
            $table->integer('precio_unitario');
            $table->integer('precio_total');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mivimiento_products');
    }
};
