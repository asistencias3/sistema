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
        $table->dateTime('fecha_inicio');
        $table->dateTime('fecha_fin');
        $table->string('tipo');
        $table->time('hora_entrada');
        $table->time('hora_salida');
        $table->time('inicio_descanso');
        $table->time('fin_descanso');
        $table->string('sucursal');
        $table->string('qr_code_data')->nullable();
        $table->string('qr_token')->nullable()->default(null);
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
