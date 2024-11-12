<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name' => fake()->sentence(),
            'payload' => json_encode([
                'id' => fake()->bothify('###?#?##?#?#?######?##?#'),
                'name' => fake()->sentence(),
                'clientId' => fake()->bothify('###?#?##?#?#?######?##?#'),
                'workspaceId' => fake()->numerify('##########'),
                'billable' => fake()->boolean(),
                'color' => fake()->hexColor(),
                'memberships' => [],
            ]),
        ];
    }
}
