<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un usuario de prueba con contraseña segura
        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'), // Contraseña hasheada
            ]
        );

        $this->call([
            WorkRecordSeeder::class,
        ]);
    }
}
