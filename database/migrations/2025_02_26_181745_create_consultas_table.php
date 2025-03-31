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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mascota_id')->constrained('mascotas');
            $table->foreignId('veterinario_id')->constrained('users');
            $table->dateTime('fecha');
            $table->unsignedBigInteger('tipo_id');
            $table->text('sintomas')->nullable();
            $table->text('diagnostico')->nullable();
            $table->text('tratamiento')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
