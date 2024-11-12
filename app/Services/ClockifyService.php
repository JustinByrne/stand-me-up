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

    public static function getWorkspaceById(string $id): array
    {
        return self::http()
            ->get(config('clockify.url').'/v1/workspaces/'.$id)
            ->json();
    }

    public static function getActiveWorkspace(): array
    {
        $id = self::getCurrentUser()['activeWorkspace'];

        return self::getWorkspaceById($id);
    }

    /*
    |--------------------------------------------------------------------------
    | Time entry functions
    |--------------------------------------------------------------------------
    */

    public static function getAllTimeEntries(): array
    {
        $workspaceId = config('clockify.workspace_id');
        $userId = config('clockify.user_id');

        return self::http()
            ->get(config('clockify.url')."/v1/workspaces/{$workspaceId}/user/{$userId}/time-entries")
            ->json();
    }

    public static function getTimeEntriesByDate(Carbon|string $date): array
    {
        if (is_string($date)) {
            $date = Carbon::parse($date);
        }

        $workspaceId = config('clockify.workspace_id');
        $userId = config('clockify.user_id');

        return self::http()
            ->withQueryParameters([
                'start' => $date->copy()->startOfDay()->toIso8601String(),
                'end' => $date->copy()->endOfDay()->toIso8601String(),
                'page-size' => 250,
            ])
            ->get(config('clockify.url')."/v1/workspaces/{$workspaceId}/user/{$userId}/time-entries")
            ->json();

    }
}
