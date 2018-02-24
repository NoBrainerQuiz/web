<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Sockets implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $questionData;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($pin, $method)
    {
        //Each class will contain the answers and so forth..
        $this->questionData = array(
             'pin' => $pin,
             'method' => $method
         );
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
     public function broadcastOn()
     {
         return ['questions'];
     }
}
