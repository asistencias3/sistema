<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadosTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('empleados')->insert([
            [
                'id_usuario' => 3, // Empleado 1
                'direccion' => 'Calle A #1',
                'telefono' => '1234567890',
                'sucursal' => 'Sucursal Centro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usuario' => 4, // Empleado 2
                'direccion' => 'Calle B #2',
                'telefono' => '2345678901',
                'sucursal' => 'Sucursal Norte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usuario' => 5, // Empleado 3
                'direccion' => 'Calle C #3',
                'telefono' => '3456789012',
                'sucursal' => 'Sucursal Sur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
