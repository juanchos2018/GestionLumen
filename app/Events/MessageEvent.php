<?php

namespace App\Events;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


use Pusher\Pusher;
class MessageEvent implements ShouldBroadcast
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     [
        //        'cluster' => env('PUSHER_APP_CLUSTER'),
        //        'useTLS'=> TRUE
        //     ]
        //  );
    }
    public function broadcastOn()
    {//este utilozo we para el pushser
        return new Channel('pizza-tracker');
    }
}
