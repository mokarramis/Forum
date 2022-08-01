<?php

namespace App\Http\Controllers\Api;

use App\Channel;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChannelResource;
use App\Http\Resources\ChannelThreadsResource;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function show(){

        $channels = Channel::get();
        //dd($channels);
        return ChannelResource::collection($channels);

    }

    public function thread(Channel $channel){
        $thread = $channel->threads()->latest()->paginate(10);
        return ChannelThreadsResource::collection($thread);
    }
}
