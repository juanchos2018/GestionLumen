<?php
namespace App\Events;
use Pusher\Pusher;
use Illuminate\Broadcasting\PrivateChannel;

class PusherEvent extends Event
{
  
   public function __construct($event, $message)
   {
      $pusher = new Pusher(
         env('PUSHER_APP_KEY'),
         env('PUSHER_APP_SECRET'),
         env('PUSHER_APP_ID'),
         [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS'=> TRUE
         ]
      );
      //new Channel('pizza-tracker');
      $pusher->trigger('my-channel', $event, $message );
   }

   public function broadcasOn(){
      return ['pizza-tracker'];
     // return new PrivateChannel("chat");
   }

}