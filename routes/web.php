<?php

use App\Http\Controllers\IdsController;
use App\Livewire\TimeEntryList;
use Illuminate\Support\Facades\Route;

Route::get('/', TimeEntryList::class);
Route::get('/ids', IdsController::class);
