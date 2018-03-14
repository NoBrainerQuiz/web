<?php

/*
  Author: UP805717 (springjben)
  
  This file is used for Laravel events. Its main purpose being to communcate the framework with the node server.
  This event is fired off when a quiz host wants to start a quiz
*/

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

    //This creates an event that is fired off to the redis server so that Laravel can communicate with the node server (and web sockets)
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
         //Upon broadcasting (event firing off) it returns the channel. Please see the main socket.io file for more information about the redis subscriptions
         return ['questions'];
     }
}
