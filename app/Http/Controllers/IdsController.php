<?php

namespace App\Http\Controllers;

use App\Services\ClockifyService;
use Illuminate\View\View;

class IdsController extends Controller
{
    public function __invoke(): View
    {
        $workspaceId = ClockifyService::getActiveWorkspace()['id'];
        $userId = ClockifyService::getCurrentUser()['id'];

        return view('ids')
            ->with([
                'workspaceId' => $workspaceId,
                'userId' => $userId,
            ]);
    }
}
