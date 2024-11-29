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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->boolean('estado')->default(0);
            $table->foreignId('id_empleado_sucursal')->constrained('empleados_sucursales')->onDelete('cascade');
            $table->date('fecha');
            $table->dateTime('hora_entrada');
            $table->dateTime('hora_salida');
            $table->dateTime('hora_segunda_entrada')->nullable();
            $table->dateTime('hora_segunda_salida')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
