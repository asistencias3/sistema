<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigracionIntervalosAsistenciaTable extends Migration
{
    public function up()
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

    public function down()
    {
        Schema::dropIfExists('intervalos_asistencia');
    }
}
