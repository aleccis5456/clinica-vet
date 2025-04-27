<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('consulta_id')->constrained('consultas')->onDelete('cascade');
            $table->foreignId('dueno_id')->constrained('duenos')->onDelete('cascade');
            $table->foreignId('mascota_id')->constrained('mascotas')->onDelete('cascade');            
            $table->foreignId('producto_consulta_id')->nullable()->constrained('consulta_productos')->onDelete('cascade');
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->string('pago_estado');
            $table->integer('monto_total');            
            $table->timestamps();
        });
    }

    /*
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('cajas');
    }
};
