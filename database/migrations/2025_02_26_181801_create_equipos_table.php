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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mascota_id')->constrained('mascotas');
            $table->foreignId('veterinaria_id')->constrained('users');
            $table->dateTime('nacimiento');
            $table->enum('tipo', ['Consulta', 'Cirugía', 'Urgencia']);
            $table->enum('estado', ['Programada', 'Completada', 'Cancelada']);
            $table->boolean('recordatorio')->default(false);
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
        Schema::dropIfExists('equipos');
    }
};
