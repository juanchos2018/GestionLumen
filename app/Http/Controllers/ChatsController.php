<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatsController extends Controller
{
    //


    public function fetchMessages()
    {
        return ['status' => 'Message recibodo!'];
    }

    public function sendMessage(Request $request)
    {
        
        // $message = $user->messages()->create([
        //     'message' => $request->input('message')
        // ]);
        return ['status' => 'Message Enviado!'];
    }
}
