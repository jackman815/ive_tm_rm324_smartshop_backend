<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RFID implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;

    public function __construct($product) {
        $this->product = $product;
    }

    public function broadcastOn() {
        return new Channel('rfid_scan');
    }

    public function broadcastWith() {
        return [
            'data' => $this->product
        ];
    }

}
