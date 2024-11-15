<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'project_id' => Project::factory(),
            'payload' => json_encode([
                'id' => fake()->bothify('###?#?##?#?#?######?##?#'),
                'name' => fake()->sentence(),
                'projectId' => fake()->bothify('###?#?##?#?#?######?##?#'),
                'status' => fake()->randomElement(['ACTIVE', 'INACTIVE']),
                'estimate' => fake()->bothify('??#?'),
            ]),
        ];
    }
}
