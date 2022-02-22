<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class NewMessage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $msg;
    public $conversation_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id,$msg,$conversation_id)
    {
        $this->user_id = $user_id;
        $this->msg = $msg;
        $this->conversation_id = $conversation_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-message');

    }
    public function broadcastAs()
    {
        return 'new_message';
    }
}
