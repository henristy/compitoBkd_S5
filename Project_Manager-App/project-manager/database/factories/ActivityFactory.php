<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $fillable = ['name', 'description', 'project_id', 'status'];
    public function definition(): array
    {
        $pId = Project::get()->random()->id;
        $status =  (Project::find($pId)->status == 'pending' ? 'todo': Project::find($pId)->status == 'completed') ? 'completed' : fake()->randomElement(['todo', 'in progress', 'completed']);
        return [
            'name' => fake()->jobTitle(),
            'description' => fake()->sentence(5),
            'project_id' => $pId,
            'status' => $status ,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
