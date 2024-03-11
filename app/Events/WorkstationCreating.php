<?php

namespace App\Events;

use App\Models\Workstation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WorkstationCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Workstation $workstation)
    {}
}
