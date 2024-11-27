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
        Schema::create('jornadas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 15);
            $table->dateTime('hora_entrada');
            $table->dateTime('hora_salida');
            $table->dateTime('hora_segunda_entrada')->nullable();
            $table->dateTime('hora_segunda_salida')->nullable();
            $table->dateTime('inicio_receso');
            $table->dateTime('fin_receso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jornadas');
    }
};

/*class CreateJornadassTable extends Migration
{
}*/
