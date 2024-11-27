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
        Schema::create('justificaciones_ausencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_asistencias')->constrained('asistencias')->onDelete('cascade');
            $table->datetime('fecha_creacion');
            $table->string('motivo', 255);
            $table->binary('comprobante')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('justificaciones_ausencia');
    }
};
