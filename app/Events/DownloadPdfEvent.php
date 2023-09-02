<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DownloadPdfEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $data;
    private $orderId;

    /**
     * Create a new event instance.
     */
    public function __construct($data,$orderId)
    {
        $this->data = $data;
        $this->orderId = $orderId;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
