<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JornadasTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jornadas')->insert([
            [
                'fecha_inicio' => '2024-11-01 08:00:00',
                'fecha_fin' => '2024-11-01 16:00:00',
                'tipo' => 'Normal',
                'hora_entrada' => '08:00:00',
                'hora_salida' => '16:00:00',
                'inicio_descanso' => '12:00:00',
                'fin_descanso' => '12:30:00',
                'sucursal' => 'Sucursal Centro',
                'qr_code_data' => 'https://example.com/jornada1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha_inicio' => '2024-11-02 08:00:00',
                'fecha_fin' => '2024-11-02 16:00:00',
                'tipo' => 'Normal',
                'hora_entrada' => '08:00:00',
                'hora_salida' => '16:00:00',
                'inicio_descanso' => '12:00:00',
                'fin_descanso' => '12:30:00',
                'sucursal' => 'Sucursal Norte',
                'qr_code_data' => 'https://example.com/jornada2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha_inicio' => '2024-11-03 08:00:00',
                'fecha_fin' => '2024-11-03 16:00:00',
                'tipo' => 'Normal',
                'hora_entrada' => '08:00:00',
                'hora_salida' => '16:00:00',
                'inicio_descanso' => '12:00:00',
                'fin_descanso' => '12:30:00',
                'sucursal' => 'Sucursal Sur',
                'qr_code_data' => 'https://example.com/jornada3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
