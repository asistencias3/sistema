<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AsistenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener algunos usuarios (empleados)
        $empleados = \App\Models\User::all();

        // Crear algunas asistencias para los empleados
        foreach ($empleados as $empleado) {
            for ($i = 0; $i < 3; $i++) { // Vamos a crear 3 registros por cada empleado
                DB::table('asistencias')->insert([
                    'estado' => rand(0, 1), // Estado aleatorio (0 o 1)
                    'id_empleado' => $empleado->id,
                    'fecha' => Carbon::now()->subDays(rand(0, 30)), // Fecha aleatoria en los últimos 30 días
                    'hora_entrada' => Carbon::now()->subDays(rand(0, 30))->setTime(rand(7, 9), rand(0, 59)), // Hora de entrada aleatoria entre 7 AM y 9 AM
                    'hora_salida' => Carbon::now()->subDays(rand(0, 30))->setTime(rand(16, 18), rand(0, 59)), // Hora de salida aleatoria entre 4 PM y 6 PM
                    'hora_segunda_entrada' => rand(0, 1) ? Carbon::now()->subDays(rand(0, 30))->setTime(rand(12, 14), rand(0, 59)) : null, // Segunda entrada aleatoria (si aplica)
                    'hora_segunda_salida' => rand(0, 1) ? Carbon::now()->subDays(rand(0, 30))->setTime(rand(17, 19), rand(0, 59)) : null, // Segunda salida aleatoria (si aplica)
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
