<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;

class TimeEntryService
{
    public static function getProject(?string $projectId): ?Project
    {
        if (is_null($projectId)) {
            return null;
        }

        $project = Project::find($projectId);

        if ($project) {
            return $project;
        }

        $payload = ClockifyService::getProjectById($projectId);

        return Project::create([
            'id' => $payload['id'],
            'name' => $payload['name'],
            'payload' => $payload,
        ]);
    }

    public static function getTask(?string $projectId, ?string $taskId): ?Task
    {
        if (is_null($taskId) || is_null($projectId)) {
            return null;
        }

        $task = Task::find($taskId);

        if ($task) {
            return $task;
        }

        $payload = ClockifyService::getTaskById($projectId, $taskId);

        $project = self::getProject($projectId);

        return Task::create([
            'id' => $payload['id'],
            'name' => $payload['name'],
            'project_id' => $project->id,
            'payload' => $payload,
        ]);
    }
}
