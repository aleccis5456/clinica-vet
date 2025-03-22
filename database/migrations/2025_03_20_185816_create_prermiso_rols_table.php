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
        Schema::create('prermiso_rols', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permiso_id');
            $table->unsignedBigInteger('rol_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prermiso_rols');
    }
};
