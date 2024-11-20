<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigracionJustificacionesAusenciaTable extends Migration
{
    public function up()
    {
        Schema::create('justificaciones_ausencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ausencia')->constrained('ausencias')->onDelete('cascade');
            $table->datetime('fecha_creacion');
            $table->string('motivo', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('justificaciones_ausencia');
    }
}
