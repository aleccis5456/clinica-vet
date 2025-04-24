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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dueno_id')->nullable()->constrained('duenos');
            $table->foreignId('consulta_id')->nullable()->constrained('consultas');
            $table->integer('monto')->nullable();
            $table->enum('forma_pago', ['efectivo', 'tarjeta', 'transferencia', 'otro'])->nullable();
            $table->string('notas')->nullable();
            $table->boolean('pagado')->default(false);
            $table->boolean('cuotas')->default(false);
            $table->integer('cantidad_pagos')->nullable();            
            $table->date('fecha_pago')->nullable();
            $table->date('fecha_vencimiento')->nullable(); // Nuevo campo
            $table->enum('estado', ['pendiente', 'parcial', 'pagado', 'cancelado'])->default('pendiente');
            $table->string('comprobante')->nullable(); // Para transferencias
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
