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
        Schema::table('tipo_consultas', function (Blueprint $table) {
            $table->integer('veces_realizadas')->after('precio')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipo_consultas', function (Blueprint $table) {
            $table->dropColumn('veces_realizadas');
        });
    }
};
