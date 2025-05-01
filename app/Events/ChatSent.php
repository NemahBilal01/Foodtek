<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Chat;

class ChatSent implements ShouldBroadcast
{
    public $chat;
    public function __construct(Chat $chat) { $this->chat = $chat; }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->chat->order_id);
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }
}
