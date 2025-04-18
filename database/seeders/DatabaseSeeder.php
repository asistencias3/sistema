<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call([
            SucursalesTableSeeder::class,
            UsersTableSeeder::class,
            EmpleadosTableSeeder::class,
            JornadasTableSeeder::class,
            EmpleadosSucursalesTableSeeder::class,
            AsistenciasTableSeeder::class,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
