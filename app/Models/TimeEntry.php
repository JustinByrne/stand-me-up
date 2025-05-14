<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeEntry extends Model
{
    /** @use HasFactory<\Database\Factories\TimeEntryFactory> */
    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'description',
        'project_id',
        'task_id',
        'start_at',
        'end_at',
        'payload',
    ];

    protected function casts(): array
    {
        return [
            'start_at' => 'timestamp',
            'end_at' => 'timestamp',
            'payload' => 'object',
        ];
    }

    protected function formattedDescription(): Attribute
    {
        return Attribute::make(function (): string {
            $issuePattern = '/^[A-Za-z]+-[0-9]+/';

            preg_match($issuePattern, $this->description, $matches);

            if (! $matches) {
                return $this->description;
            }

            $issue = $matches[0];
            $issueLink = $this->linked_issue;
            $message = substr($this->description, strlen($issue));
            $taskName = strtolower($this->task->name);

            if (in_array($taskName, config('clockify.testing_tasks'))) {
                $message = 'acceptance testing';
            }

            if (in_array($taskName, config('clockify.reviewing_tasks'))) {
                $message = 'PR Review';
            }

            return $issueLink.' - '.$message;
        });
    }

    protected function linkedIssue(): Attribute
    {
        return Attribute::make(function (): ?string {
            $issuePattern = '/^[A-Za-z]+-[0-9]+/';

            preg_match($issuePattern, $this->description, $matches);

            if (! $matches) {
                return null;
            }

            $issue = $matches[0];

            return '<a href="'.config('repo.url').'/'.$issue.'">'.$issue.'</a>';
        });
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
