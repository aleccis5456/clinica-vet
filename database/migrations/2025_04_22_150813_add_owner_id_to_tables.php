<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() :void {
        Schema::table('categorias', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');            
        });

        Schema::table('consulta_productos', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('consultas', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('datos_facturas', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('duenos', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('especies', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('mascotas', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('mivimiento_products', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('movimientos', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('notificaciones', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('prermiso_rols', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('productos', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('cascade');
        });
         
        Schema::table('tipo_consultas', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });

        Schema::table('veterinarios_consulta', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() :void {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
