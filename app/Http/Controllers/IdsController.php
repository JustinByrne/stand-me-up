<?php

namespace App\Http\Controllers;

use App\Services\ClockifyService;
use App\Services\EnvService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IdsController extends Controller
{
    public function index(): View
    {
        $workspaceId = ClockifyService::getActiveWorkspace()['id'];
        $userId = ClockifyService::getCurrentUser()['id'];

        return view('ids')
            ->with([
                'workspaceId' => $workspaceId,
                'userId' => $userId,
            ]);
    }

    public function setIds(): RedirectResponse
    {
        $workspaceId = ClockifyService::getActiveWorkspace()['id'];
        EnvService::replaceVariable('CLOCKIFY_WORKSPACE_ID', $workspaceId);

        $userId = ClockifyService::getCurrentUser()['id'];
        EnvService::replaceVariable('CLOCKIFY_USER_ID', $userId);

        return redirect('/');
    }
}
