<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function index()
    {
       event(new \App\Events\PusherEvent('notification', 'hello world'));
    }
    public function sendMessage(Request $request)
    {      
        return ['status' => 'Message Evniado!'];
    }
}
