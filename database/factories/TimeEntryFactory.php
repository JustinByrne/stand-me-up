<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeEntry>
 */
class TimeEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(),
            'project_id' => Project::factory(),
            'task_id' => function (array $attributes) {
                return Task::factory()->for(Project::find($attributes['project_id']));
            },
            'start_at' => Carbon::now()->subHour(),
            'end_at' => Carbon::now()->addHour(),
            'payload' => json_encode([
                'id' => fake()->bothify('###?#?##?#?#?######?##?#'),
                'description' => fake()->sentence(),
                'projectId' => fake()->bothify('###?#?##?#?#?######?##?#'),
                'taskId' => fake()->bothify('###?#?##?#?#?######?##?#'),
                'start' => Carbon::now()->subHour()->toIso8601String(),
                'end' => Carbon::now()->addHour()->toIso8601String(),
                'billable' => fake()->boolean(),
                'userId' => fake()->numerify('##########'),
                'workspaceId' => fake()->numerify('##########'),
            ]),
        ];
    }
}
