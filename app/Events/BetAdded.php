<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BetAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $game_id;
    private $channel_name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($channel, $user_id, $game_id)
    {
        $this->channel_name = $channel;
        $this->user_id = $user_id;
        $this->game_id = $game_id;
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
        return 'bet_added';
    }
}
