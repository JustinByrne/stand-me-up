<?php

namespace App\Livewire;

use App\Models\TimeEntry;
use App\Services\ClockifyService;
use App\Services\TimeEntryService;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TimeEntryList extends Component
{
    #[Url]
    #[Validate('sometimes|date_format:Y-m-d')]
    public ?string $date = null;

    public function mount()
    {
        if (is_null($this->date)) {
            $this->date = Carbon::now()->subDay()->format('Y-m-d');
        }
    }

    public function render()
    {
        $date = Carbon::createFromFormat('Y-m-d', $this->date);

        collect(ClockifyService::getTimeEntriesByDate($date))->each(function (array $entry) {
            $timeEntry = TimeEntry::find($entry['id']);

            if ($timeEntry) {
                return;
            }

            $project = TimeEntryService::getProject(projectId: $entry['projectId']);
            $task = TimeEntryService::getTask(projectId: $entry['projectId'], taskId: $entry['taskId']);

            TimeEntry::create([
                'id' => $entry['id'],
                'description' => $entry['description'],
                'project_id' => $project?->id,
                'task_id' => $task?->id,
                'start_at' => Carbon::parse($entry['timeInterval']['start']),
                'end_at' => Carbon::parse($entry['timeInterval']['end']),
                'payload' => $entry,
            ]);
        });

        $timeEntries = TimeEntry::with([
            'project',
            'task',
        ])
            ->where('start_at', 'like', $date->format('Y-m-d').'%')
            ->groupBy('description')
            ->get();

        return view('livewire.time-entry-list')
            ->with('timeEntries', $timeEntries);
    }
}
