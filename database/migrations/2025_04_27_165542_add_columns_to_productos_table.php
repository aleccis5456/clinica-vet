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
        Schema::table('productos', function (Blueprint $table) {
            $table->string('unidad_medida')->nullable();
            $table->integer('cantidad')->nullable();
            $table->float('precio_interno')->nullable();
            $table->string('unidad_capacidad')->nullable();
            $table->integer('cantidad_capacidad')->nullable();
            $table->integer('sobrante')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            //
        });
    }
};
