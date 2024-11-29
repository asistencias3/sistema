<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadosSucursalesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('empleados_sucursales')->insert([
            [
                'id_empleado' => 1, // Empleado 1
                'id_sucursal' => 1, // Sucursal Centro
                'id_jornada' => 1, // Jornada 1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_empleado' => 2, // Empleado 2
                'id_sucursal' => 2, // Sucursal Norte
                'id_jornada' => 2, // Jornada 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_empleado' => 3, // Empleado 3
                'id_sucursal' => 3, // Sucursal Sur
                'id_jornada' => 3, // Jornada 3
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
