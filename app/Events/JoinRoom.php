<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JoinRoom implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $pseudo;
    private $channel_name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($pseudo, $channel_name)
    {
        $this->pseudo = $pseudo;
        $this->channel_name = $channel_name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->channel_name);
    }

    public function broadcastAs()
    {
        return 'room_joined';
    }
}
