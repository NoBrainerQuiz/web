<?php

/*
  Author: UP805717 (springjben)
  
  This file is used for Laravel events when a user is added to the site.
  This event is fired off when a user creates a username (only in the /pin page)
*/

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class addUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username)
    {
        //Each class will contain the answers and so forth..
        $this->user = array(
             'name' => $username
         );
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
     public function broadcastOn()
     {
         //This is passing the data onto the addUser channel (using Redis)
         return ['addUser'];
     }
}
