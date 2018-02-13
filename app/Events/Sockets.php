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
    private $power = 0;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($power)
    {
        echo 'test';
        //
        $this->power = $power;
        /*$this->data = array(
             'power'=> '10'
         );*/
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
     public function broadcastOn()
     {
         return ['test-channel'];
     }
}
