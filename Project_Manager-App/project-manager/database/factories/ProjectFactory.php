<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-4 years', 'now');
        $end = fake()->dateTimeBetween($start, '+4 years');

        
        return [
            'name' => fake()->company(),
            'description' => fake()->paragraph(10),
            'start_date' => $start,
            'end_date' => $end,
            'status' => $end < now() ? 'completed' : fake()->randomElement(['active', 'paused', 'pending']),
            'user_id' => User::get()->random()->id,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
