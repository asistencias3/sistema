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
        Schema::create('intervalos_asistencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_asistencia')->constrained('asistencias')->onDelete('cascade');
            $table->datetime('fecha_date');
            $table->datetime('hora_entrada');
            $table->datetime('hora_salida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervalos_asistencia');
    }
};
