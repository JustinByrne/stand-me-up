<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

final class ClockifyService
{
    private static function http()
    {
        return Http::accept('application/json')
            ->withHeaders([
                'x-api-key' => config('clockify.api_key'),
            ]);
    }

    private static function workspaceUrl(): string
    {
        $workspaceId = config('clockify.workspace_id');

        return config('clockify.url')."/v1/workspaces/{$workspaceId}";
    }

    private static function userUrl(): string
    {
        $userId = config('clockify.user_id');

        return self::workspaceUrl()."/user/{$userId}";
    }

    /*
    |--------------------------------------------------------------------------
    | User functions
    |--------------------------------------------------------------------------
    */

    public static function getCurrentUser(): array
    {
        return self::http()
            ->get(config('clockify.url').'/v1/user')
            ->json();
    }

    /*
    |--------------------------------------------------------------------------
    | Workspace functions
    |--------------------------------------------------------------------------
    */

    public static function getWorkspaces(): array
    {
        return self::http()
            ->get(config('clockify.url').'/v1/workspaces')
            ->json();
    }

    public static function getWorkspaceById(string $workspaceId): array
    {
        return self::http()
            ->get(config('clockify.url').'/v1/workspaces/'.$workspaceId)
            ->json();
    }

    public static function getActiveWorkspace(): array
    {
        $id = self::getCurrentUser()['activeWorkspace'];

        return self::getWorkspaceById($id);
    }

    /*
    |--------------------------------------------------------------------------
    | Project functions
    |--------------------------------------------------------------------------
    */

    public static function getProjects(): array
    {
        return self::http()
            ->get(self::workspaceUrl().'/projects')
            ->json();
    }

    public static function getProjectById(string $projectId): array
    {
        return self::http()
            ->get(self::workspaceUrl()."/projects/{$projectId}")
            ->json();
    }

    /*
    |--------------------------------------------------------------------------
    | Task functions
    |--------------------------------------------------------------------------
    */

    public static function getTasks(string $projectId): array
    {
        return self::http()
            ->get(self::workspaceUrl()."/projects/{$projectId}/tasks")
            ->json();
    }

    public static function getTaskById(string $projectId, string $taskId): array
    {
        return self::http()
            ->get(self::workspaceUrl()."/projects/{$projectId}/tasks/{$taskId}")
            ->json();
    }

    /*
    |--------------------------------------------------------------------------
    | Time entry functions
    |--------------------------------------------------------------------------
    */

    public static function getTimeEntries(): array
    {
        return self::http()
            ->get(self::userUrl().'/time-entries')
            ->json();
    }

    public static function getTimeEntriesByDate(Carbon|string $date): array
    {
        if (is_string($date)) {
            $date = Carbon::parse($date);
        }

        return self::http()
            ->withQueryParameters([
                'start' => $date->copy()->startOfDay()->toIso8601String(),
                'end' => $date->copy()->endOfDay()->toIso8601String(),
                'page-size' => 250,
            ])
            ->get(self::userUrl().'/time-entries')
            ->json();

    }
}
