<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Reply;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Reply $reply){
        $reply->favorites()->create([
            'user_id' => auth()->id(),
            'favorite_id' => $reply->id,
            'favorite_type' => get_class($reply)

        ]);

        return [
            'status' => true,
            'message' => 'به علاقه مندی ها افزوده شد.'
        ];
    }
}
