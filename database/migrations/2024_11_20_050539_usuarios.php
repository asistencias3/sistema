<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_usuario', 10);
            $table->string('correo', 20)->unique();
            $table->string('contraseña', 20);
            $table->unsignedTinyInteger('rol')->default(3); // 1: Administradores, 2: Recursos Humanos, 3: Empleados
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
