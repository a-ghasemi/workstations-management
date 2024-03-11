<?php

namespace App\Listeners;

use App\Events\WorkstationCreating;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckNameOrUserAvailability
{
    public function handle(WorkstationCreating $event): void
    {
        if (is_null($event->workstation->name) && is_null($event->workstation->user?->id)) {
            throw new \Exception('A workstation must have either a name or an assigned user.');
        }
    }
}
