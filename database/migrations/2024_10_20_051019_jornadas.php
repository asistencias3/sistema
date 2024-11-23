<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Jornadas extends Migration
{
    public function up()
    {
        Schema::create('jornadas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 15);
            $table->datetime('hora_entrada');
            $table->datetime('hora_salida');
            $table->integer('minutos_descanso');
            $table->datetime('hora_segunda_entrada')->nullable();
            $table->datetime('hora_segunda_salida')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jornadas');
    }
}
