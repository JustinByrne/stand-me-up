<?php

use App\Http\Controllers\ClockifyController;
use App\Http\Controllers\IdsController;
use App\Http\Middleware\ClockifyNotProvided;
use App\Http\Middleware\EnsureClockifyIsProvided;
use App\Livewire\TimeEntryList;
use Illuminate\Support\Facades\Route;

Route::middleware(EnsureClockifyIsProvided::class)
    ->group(function () {
        Route::get('/', TimeEntryList::class);

        Route::get('/ids', [IdsController::class, 'index']);
        Route::post('/ids', [IdsController::class, 'setIds']);
    });

Route::middleware(ClockifyNotProvided::class)
    ->group(function () {
        Route::get('/missing-api-key', [ClockifyController::class, 'edit'])->name('missing-token');
        Route::post('/missing-api-key', [ClockifyController::class, 'update']);
    });
