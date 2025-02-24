<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WorkRecord;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WorkRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un usuario de prueba
        $user = User::firstOrCreate([
            'email' => 'admin@admin.com'
        ], [
            'name' => 'Test User',
            'password' => Hash::make('password')
        ]);

        // Crear registros de trabajo asociados al usuario
        WorkRecord::factory(10)->create([
            'user_id' => $user->id
        ]);
    }
}
