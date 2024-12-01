<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SucursalesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sucursales')->insert([
            [
                'nombre' => 'Sucursal Centro',
                'direccion' => 'Calle Principal #123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sucursal Norte',
                'direccion' => 'Avenida Norte #456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sucursal Sur',
                'direccion' => 'Calle Sur #789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
