<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigracionAsistenciasAusenciasTable extends Migration
{
    public function up()
    {
        Schema::create('asistencias_ausencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_asistencia')->constrained('asistencias')->onDelete('cascade');
            $table->foreignId('id_ausencia')->constrained('ausencias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asistencias_ausencias');
    }
}
