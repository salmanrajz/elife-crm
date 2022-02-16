<?php

namespace App\Events;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $userid;

    public function __construct($message,$userid)
    {
        $this->message = $message;
        $this->userid = $userid;

    }

    public function broadcastOn()
    {
        // return ['my-channel'];
        return ['my-channel_' . $this->userid];

    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
