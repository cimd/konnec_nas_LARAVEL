<?php

namespace App\Events;

// use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
// use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
// use App\Models\Auth\User;
use Illuminate\Queue\SerializesModels;

// use Illuminate\Support\Facades\Log;

class TerminalMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->user = auth()->user();
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn(): array
    {
        return new PrivateChannel('user.'.$this->user->id);
    }

    public function broadcastAs()
    {
        return 'terminal-message';
    }

    public function broadcastWith()
    {
        return ['message' => $this->message];
    }

    // public function broadcastWhen()
    // {
    //     return true;
    // }
}
