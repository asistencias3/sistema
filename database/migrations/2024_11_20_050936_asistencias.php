<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Asistencias extends Migration
{
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empleado_sucursal')->constrained('empleados_sucursales')->onDelete('cascade');
            $table->date('fecha');
            $table->datetime('hora_entrada');
            $table->datetime('hora_salida');
            $table->datetime('hora_segunda_entrada')->nullable();
            $table->datetime('hora_segunda_salida')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asistencias');
    }
}
