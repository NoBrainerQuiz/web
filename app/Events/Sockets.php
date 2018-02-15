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
    public function __construct()
    {
        //Each class will contain the answers and so forth..
        $this->questionData = array(
             'question-no' => 1,
             'timer' => 3,
             'question' => "How good is No-Brainer?",
             'ans-1' => "Amazing",
             'ans-2' => "Wrong Answer",
             'ans-3' => "Wrong Answer",
             'ans-4' => "Wrong Answer"
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
