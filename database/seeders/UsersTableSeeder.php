<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Administrador',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'rol' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Recursos Humanos',
                'email' => 'recursoshumanos@example.com',
                'password' => Hash::make('password123'),
                'rol' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Empleado 1',
                'email' => 'empleado1@example.com',
                'password' => Hash::make('password123'),
                'rol' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Empleado 2',
                'email' => 'empleado2@example.com',
                'password' => Hash::make('password123'),
                'rol' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Empleado 3',
                'email' => 'empleado3@example.com',
                'password' => Hash::make('password123'),
                'rol' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Cinthia Torres',
                'email' => 'cinthia123@gmail.com',
                'password' => Hash::make('cinthia123'),
                'rol' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
