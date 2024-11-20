<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Recesos extends Migration
{
    public function up()
    {
        Schema::create('recesos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_asistencia')->constrained('asistencias')->onDelete('cascade');
            $table->datetime('inicio_receso');
            $table->datetime('fin_receso');
            $table->integer('duracion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recesos');
    }
}
