<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ausencias extends Migration
{
    public function up()
    {
        Schema::create('ausencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empleado_sucursal')->constrained('empleados_sucursales')->onDelete('cascade');
            $table->date('fecha');
            $table->string('estado', 15);
            $table->binary('comprobante')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ausencias');
    }
}
