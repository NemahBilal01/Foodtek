<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeliveryLocationUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderId;
    public $latitude;
    public $longitude;

    public function __construct($orderId, $latitude, $longitude)
    {
        $this->orderId = $orderId;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function broadcastOn()
    {
        return new Channel('order-tracking.' . $this->orderId);
    }

    public function broadcastAs()
    {
        return 'location.updated';
    }
}
