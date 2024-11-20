<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpleadosSucursales extends Migration
{
    public function up()
    {
        Schema::create('empleados_sucursales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empleado')->constrained('empleados')->onDelete('cascade');
            $table->foreignId('id_sucursal')->constrained('sucursales')->onDelete('cascade');
            $table->foreignId('id_jornada')->constrained('jornadas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleados_sucursales');
    }
}
