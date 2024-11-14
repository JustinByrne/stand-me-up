<?php

namespace App\Http\Controllers;

use App\Services\EnvService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClockifyController extends Controller
{
    public function edit(): View
    {
        return view('clockify.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'api_key' => 'required|string',
        ]);

        if (! EnvService::replaceVariable('CLOCKIFY_API_KEY', $request->api_key)) {
            return redirect()->route('missing-token')
                ->with('message', 'Failed to update env file');
        }

        return redirect('/ids');
    }
}
