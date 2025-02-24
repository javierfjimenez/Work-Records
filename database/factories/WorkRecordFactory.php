<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WorkRecord;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkRecord>
 */
class WorkRecordFactory extends Factory
{
    protected $model = WorkRecord::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Relación con usuario
            'title' => $this->faker->sentence,
            'start_time' => now()->subHours(rand(1, 10)),
            'end_time' => now(),
            'priority' => $this->faker->randomElement(['baja', 'media', 'alta']),
            'description' => $this->faker->paragraph,
        ];
    }
}
