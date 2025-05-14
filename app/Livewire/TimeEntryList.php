<?php

namespace App\Livewire;

use App\Models\TimeEntry;
use App\Services\ClockifyService;
use App\Services\TimeEntryService;
use Carbon\Carbon;
use Livewire\Attributes\Title;
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

    #[Title('My Stand Up')]
    public function render()
    {
        $date = Carbon::createFromFormat('Y-m-d', $this->date);

        $this->storeTimeEntries($date);

        $timeEntries = [];

        TimeEntry::with(['task'])
            ->where('start_at', 'like', $date->format('Y-m-d').'%')
            ->get()
            ->each(function (TimeEntry $entry) {
                $entry->append(['linked_issue', 'formatted_description']);
            })
            ->groupBy(['task.name', 'description'])
            ->each(function ($collection, $task) use (&$timeEntries) {
                if (
                    in_array(strtolower($task), config('clockify.reviewing_tasks')) ||
                    in_array(strtolower($task), config('clockify.testing_tasks'))
                ) {
                    $taskList = '';
                    foreach ($collection->toArray() as $entry) {
                        if (strlen($taskList)) {
                            $taskList .= ', ';
                        }

                        $taskList .= $entry[0]['linked_issue'];
                    }

                    if (in_array(strtolower($task), config('clockify.testing_tasks'))) {
                        $task = 'acceptance testing';
                    }

                    if (in_array(strtolower($task), config('clockify.reviewing_tasks'))) {
                        $task = 'PR Review';
                    }

                    $timeEntries[] = $taskList.' - '.$task;

                    return;
                }

                $timeEntries[] = $collection->first()[0]['formatted_description'];
            });

        return view('livewire.time-entry-list')
            ->with('timeEntries', $timeEntries);
    }

    private function storeTimeEntries(Carbon $date): void
    {
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
    }
}
